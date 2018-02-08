<?php 

namespace CloudComm;

use Illuminate\Support\Facades\Log;

/**
 * Description of CloudComm
 *
 * @author Yan Lin Wang <charles.w.developer@gmail.com>
 */

class WebService
{
    /*
    |--------------------------------------------------------------------------
    | Web Service Name
    |--------------------------------------------------------------------------
    |
    |
    |
    */     
    protected $name;

    /*
    |--------------------------------------------------------------------------
    | Web Service
    |--------------------------------------------------------------------------
    |
    |
    |
    */     
    protected $service;
    
    /*
    |--------------------------------------------------------------------------
    | SDK APP ID
    |--------------------------------------------------------------------------
    |
    |
    |
    */     
    protected $sdkappid;

    /*
    |--------------------------------------------------------------------------
    | Identifier
    |--------------------------------------------------------------------------
    |
    |
    |
    */     
    protected $identifier;

    /*
    |--------------------------------------------------------------------------
    | UserSig
    |--------------------------------------------------------------------------
    |
    |
    |
    */     
    protected $usersig;

    /*
    |--------------------------------------------------------------------------
    | API Endpoint
    |--------------------------------------------------------------------------
    |
    |
    |
    */     
    protected $endpoint;
    
    /*
    |--------------------------------------------------------------------------
    | Service URL
    |--------------------------------------------------------------------------
    |
    |
    |
    */     
    protected $requestUrl;

    /**
     * Class constructor
     */
    public function __construct()
    { 
        
    }
    
    /**
     * Set parameter by key.
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setParamByKey($key, $value)
    {
        array_set($this->service['param'], $key, $value);
        
        return $this;
    }
    
    /**
     * Get parameter by the key.
     * @param string $key
     * @return mixed
     */ 
    public function getParamByKey($key)
    {
        if (array_key_exists($key, array_dot($this->service['param'])))
        {
            return array_get($this->service['param'], $key);
        }
    }
    
    /**
     * Set all parameters at once.
     * @param array $param
     * @return $this
     */
    public function setParam($param)
    {
        switch ($this->name)
        {
            case 'batchrequest':
                $this->service['param']['batch'] = json_encode($param);
                break;
            default:
                foreach (array_dot($param) as $key => $value)
                {
                    $this->setParamByKey($key, $value);
                }
                break;
        }

        return $this;
    }

    /**
     * Return parameters array.
     * @return array
     */
    public function getParam()
    {
        return $this->service['param'];
    }
    
    /**
     * Set target endpoint by key.
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setTargetEndpointByKey($key, $value)
    {
        $this->requestUrl = preg_replace('/\/:' . $key . '\//', '/' . $value . '/', $this->requestUrl);

        return $this;
    }

    /**
     * Set all targets in endpoint at once.
     * @param array $targets        Target name => ID of targets.
     * @return $this
     */
    public function setTargetEndpoint($targets)
    {
        foreach ($targets as $key => $value)
        {
            $this->setTargetEndpointByKey($key, $value);
        }

        return $this;
    }

    /**
     * 
     */
    public function setID($targets)
    {
        if (is_array($targets))
        {
            $this->setTargetEndpoint($targets);
        } else {
            $this->requestUrl = preg_replace('/\/:\w+\//', '/' . $targets . '/', $this->requestUrl);
        }

        return $this;
    }
    
    /**
     * Get Web Service Response.
     * @param string $needle        Response key.
     * @return string
     */
    public function get($needle = false)
    {
        return empty($needle)
                ? $this->getResponse()
                : $this->getResponseByKey($needle);
    }

    /**
     * Post JSON to Web Service.
     * @return type
     */
    public function post()
    {
        return $this->make(json_encode($this->service['param']));
    }
    
    /**
     * Get response value by key.
     * @param string $needle        Retrieves response parameter using "dot" notation.
     * @param int $offset 
     * @param int $length
     * @return array
     */
    public function getResponseByKey($needle = false, $offset = 0, $length = null)
    {
        // set default key parameter
        $needle = empty($needle) 
                    ? metaphone($this->service['responseDefaultKey']) 
                    : metaphone($needle);
        
        // get response
        $obj = json_decode($this->get(), true);
            
        // flatten array into single level array using 'dot' notation
        $obj_dot = array_dot($obj);
        // create empty response
        $response = [];
        // iterate 
        foreach ($obj_dot as $key => $val)
        {
            // Calculate the metaphone key and compare with needle
            if (strcmp(metaphone($key, strlen($needle)), $needle) === 0)
            {
                // set response value
                array_set($response, $key, $val);
            }
        }

        return count($response) < 1
               ? $obj
               : $response;
    }
    
    /**
     * Get response status.
     * @return mixed
     */
    public function getStatus()
    {
        // get response
        $obj = json_decode($this->get(), true);
        
        return array_get($obj, 'status', null);
    }

    /**
     * Make batch request param.
     * @return json Full request url.
     */
    public function getBatchJson()
    {
        $batch_json = [
            'method'            => $this->service['type'],
            'relative_url'      => str_replace(config('cloudcomm.url'), '', $this->requestUrl)
        ];

        switch ($this->service['type'])
        {
            case 'POST':
                $batch_json['body'] = $body;
                break;
            case 'GET':
                $batch_json['relative_url'] .= $this->getBody(true);
                break;
            default:
                $batch_json['relative_url'] .= $this->getBody(true);
                break;
        }

        return json_decode(json_encode($batch_json));
    }
    
    
    /*
    |--------------------------------------------------------------------------
    | Protected methods
    |--------------------------------------------------------------------------
    |
    */     
   
    /**
     * Setup service parameters.
     */
    protected function build($service)
    {
        $this->validateConfig($service);

        $this->name = $service;
        
        // set web service parameters 
        $this->service = config('cloudcomm.service.'.$service);
        
        // if sdkappid set, use it, otherwise use default sdkappid
        $this->sdkappid = empty($this->service['sdkappid'])
                        ? config('cloudcomm.sdkappid')
                        : $this->service['sdkappid'];

        // if identifier set, use it, otherwise use default identifier
        $this->identifier = empty($this->service['identifier'])
        ? config('cloudcomm.identifier')
        : $this->service['identifier'];

        // if usersig set, use it, otherwise use default usersig
        $this->usersig = empty($this->service['usersig'])
                        ? config('cloudcomm.usersig')
                        : $this->service['usersig'];
        
        // set service url
        $this->requestUrl = config('cloudcomm.url') . $this->service['endpoint'];
    }
    
    /**
     * Validate configuration file.
     * @throws \ErrorException
     */ 
    protected function validateConfig($service)
    {
        // Check for config file
        if (!\Config::has('cloudcomm'))
        {
            throw new \ErrorException('Unable to find config file.');
        }

        // Validate sdkappid parameter
        if (!array_key_exists('sdkappid', config('cloudcomm')))
        {
            throw new \ErrorException('Unable to find sdkappid parameter in configuration file.');
        }

        // Validate identifier parameter
        if (!array_key_exists('identifier', config('cloudcomm')))
        {
            throw new \ErrorException('Unable to find identifier parameter in configuration file.');
        }
        
        // Validate usersig parameter
        if (!array_key_exists('usersig', config('cloudcomm')))
        {
            throw new \ErrorException('Unable to find usersig parameter in configuration file.');
        }

        // Validate API URL parameter
        if (!array_key_exists('url', config('cloudcomm')))
        {
            throw new \ErrorException('Unable to find API URL parameter in configuration file.');
        }
        
        // Validate Service parameter
        if (!array_key_exists('service', config('cloudcomm'))
                && !array_key_exists($service, config('cloudcomm.service')))
        {
            throw new \ErrorException('Web service must be declared in the configuration file.');
        }
    }
    
    /**
     * Get parameter body of url.
     * @return string
     */
    protected function getBody($has_first_param=false)
    {
        $body = '';
        $is_first_param = false;
        if ($has_first_param)
        {
            $is_first_param = true;
        }

        if (empty($this->service['param']))
        {
            return $body;
        }
        
        foreach (array_dot($this->service['param']) as $key => $value)
        {
            if (is_null($value))
            {
                continue;
            }
            if ($is_first_param)
            {
                $body .= '?';
                $is_first_param = false;
            } else {
                $body .= '&';
            }
            $body .= $key . '=' . $value;
        }

        return $body;
    }

    /**
     * Get Web Service Response.
     * @return type
     */
    protected function getResponse()
    {
        $post = false;
        
        // set API 
        $this->requestUrl .= '?sdkappid=' . $this->sdkappid;
        $this->requestUrl .= '&usersig=' . $this->usersig;
        $this->requestUrl .= '&identifier=' . $this->identifier;
        $this->requestUrl .= '&contenttype=json';

        switch($this->service['type'])
        {
            case 'POST':
                $post = json_encode($this->service['param']);
                break;
            case 'GET':
            default:
                $this->requestUrl .= $this->getBody();
                break;
        }
        
        return $this->make($post);
    }
    
    /**
     * Make cURL request to given URL.
     * @param boolean $isPost
     * @return object
     */
    protected function make($isPost = false)
    {
        $ch = curl_init($this->requestUrl);
       
        if ($isPost)
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json;charset=UTF-8',
                'Content-Length: ' . strlen($isPost)
            ));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $isPost);
        }
       
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $output = curl_exec($ch);
       
        if ($output === false)
        {
            throw new \ErrorException(curl_error($ch));
        }

        curl_close($ch);
        return $output;
    }
}

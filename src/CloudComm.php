<?php 

namespace CloudComm;

/**
 * Description of CloudComm
 *
 * @author Yan Lin Wang <charles.w.developer@gmail.com>
 */

class CloudComm extends \CloudComm\WebService
{
    /**
     * Array of classes to handle web service request
     * By default WebService class will be used
     * @var service => class to use
     */
    protected $webServices = [];
    
      
    /**
     * Bootstraping Web Service
     * @param string $service
     * @return \CloudComm\WebService
     */
    public function load($service)
    {
        // is overwrite class specified 
        $class = array_key_exists($service, $this->webServices)
                ? new $this->webServices[$service]
                : $this;
        
        $class->build($service);

        return $class;
    }
    
    protected function build($service)
    {
        parent::build($service);
    }
}

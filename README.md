## Collection of Tencent Cloud Communication Web Services API Adapter for Laravel 5 

Provides convenient way of setting up and making requests to Tencent Cloud Communication Web Services API from [Laravel](http://laravel.com/) application. 

For services documentation, APP key and Usage Limits visit:
* [Tencent Cloud Communication Services Documentation](https://cloud.tencent.com/document/product/269)
* [Tencent Cloud Communication Services APP Key](https://cloud.tencent.com/document/product/269/1504)
* [Tencent Cloud Communication Services Price and Quota](https://cloud.tencent.com/document/product/269/11673)
* [Tencent Cloud Communication Services Usage Limit](https://cloud.tencent.com/document/product/269/9346)

**SPECIAL THANKS TO [Alexpechkarev](https://github.com/alexpechkarev/). Part of web services engine is borrowed from [Alexpechkarev/google-maps](https://github.com/alexpechkarev/google-maps/).


[Features](https://cloud.tencent.com/document/product/269/1520)
------------
* Account Management
* Send Message
* Push Notifications
* Group Management
* Profile Picture Management
* Chain Relationship Management
* Chat Censor Management
* Data Download
* Online Status
* Global Chat Restriction Management


Dependency
------------
* [PHP cURL](http://php.net/manual/en/curl.installation.php)
* [PHP 7](http://php.net/)


Installation
------------

Issue following command in console:

```php
composer require imphinite/tencent-cloudcomm
```

Alternatively  edit composer.json by adding following line and run **`composer update`**
```php
"require": { 
		....,
		"imphinite/tencent-cloudcomm",
	
	},
```

Configuration
------------

Register package service provider and facade in 'config/app.php'

```php
'providers' => [
    ...
    CloudComm\ServiceProvider\CloudCommServiceProvider::class,
]

'aliases' => [
    ...
    'CloudComm' => CloudComm\Facades\CloudComm::class,
]
```


Publish configuration file using **`php artisan vendor:publish --tag=cloudcomm --force`** or simply copy package configuration file and paste into **`config/cloudcomm.php`**

Open configuration file **`config/cloudcomm.php`** and 
1. Add your app key
2. Add your appication admin identifier
3. Add your admin usersig
(All of above are obtained from your App in Tencent Cloud Communication Services Console)
```php
    /*
    |----------------------------------
    | SDK App ID
    |------------------------------------
    */
    
    'sdkappid'          => 'YOUR APP ID',
    ...,
    /*
    |----------------------------------
    | Identifier
    |------------------------------------
    */
    
    'identifier'          => 'YOUR APP ADMIN IDENTIFIER',
    ...,
    /*
    |----------------------------------
    | API UserSig
    |------------------------------------
    */
    
    'usersig'           => 'YOUR ADMIN USERSIG',
```

If you like to use different admins for any of the services, you can overwrite master admin identifier and usersig by specifying them in the `service` array for selected web service. 


Usage
------------

Import this package at the top of your file:

```php
use CloudComm;
...
```

Here is an example of making request to Tencent-hosted Account Registration API:

```php
$service = CloudComm::load('register-account')
    ->setParam([
        'Identifier'            => 'testaccount1',
        'IdentifierType'        => 3,  // refer to Tencent documentation
        'Password'              => 'Testaccount1Password!'
    ]);
$response = $service->get();
...
```

Alternatively parameters can be set using `setParamByKey()` method. For deeply nested array use "dot" notation as per example below.

```php
$service = CloudComm::load('register-account')
    ->setParamByKey('Identifier', 'testaccount1')
    ->setParamByKey('IdentifierType', 3)
    ->setParamByKey('Password', 'Testaccount1Password!');  //return $this
...
```

Another example showing request to Get User Status API:

```php
$service = CloudComm::load('get-user-status')
    ->setParam([
        'To_Account'            => [
            'testaccount1',
            'testaccount2'
        ]
    ]);
$response = $service->get();
...
```

Available methods
------------

* [`load( $serviceName )`](#load)
* [`setParamByKey( $key, $value )`](#setParamByKey)
* [`setParam( $parameters )`](#setParam)
* [`get()`](#get)

---

<a name="load"></a>
**`load( $serviceName )`** - load web service by name 

Accepts string as parameter, web service name as specified in configuration file.  
Returns reference to it's self.

```php
CloudComm::load('nearbysearch') 
...
```

---

<a name="setParamByKey"></a>
**`setParamByKey( $key, $value )`** - set request parameter using key:value pair

Accepts two parameters:
* `key` - body parameter name
* `value` - body parameter value 

Deeply nested array can use 'dot' notation to assign value.  
Returns reference to it's self.

```php
$service = CloudComm::load('register-account')
    ->setParamByKey('Identifier', 'testaccount1')
    ->setParamByKey('IdentifierType', 3)
    ->setParamByKey('Password', 'Testaccount1Password!');  //return $this
...
```

---

<a name="setParam"></a>
**`setParam( $parameters )`** - set all request parameters at once

Accepts array of parameters  
Returns reference to it's self.

```php
$service = CloudComm::load('register-account')
    ->setParam([
        'Identifier'            => 'testaccount1',
        'IdentifierType'        => 3,  // refer to Tencent documentation
        'Password'              => 'Testaccount1Password!'
    ]);
...
```

---

<a name="get"></a>
* **`get()`** - perform web service request (irrespectively to request type POST or GET )

```php
$response = CloudComm::load('register-account')
    ->setParam([
        'Identifier'            => 'testaccount1',
        'IdentifierType'        => 3,  // refer to Tencent documentation
        'Password'              => 'Testaccount1Password!'
    ])->get();

var_dump(json_decode($response));  // output 
...
```

MIT License
-------

Collection of Tencent Cloud Communication Web Services API Adapter for Laravel 5 is released under the [MIT License](https://github.com/imphinite/tencent-cloudcomm/blob/master/LICENSE).
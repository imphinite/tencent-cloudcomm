<?php

namespace CloudComm\ServiceProvider;

use CloudComm\CloudComm;
use Illuminate\Support\ServiceProvider;

class CloudCommServiceProvider extends ServiceProvider
{
    /**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;
    

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
                __DIR__.'/../config/cloudcomm.php' => config_path('cloudcomm.php'),
            ], 'cloudcomm');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('CloudComm', function()
        {
            return new CloudComm;
        });
    }
        
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('CloudComm');
    }
}

<?php namespace Three\Fileserver;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class FileserverServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
             $this->package('three/fileserver');
 
            // Add my database configurations to the default set of configurations                        
             $this->app['config']['database.connections'] = array_merge(
                  $this->app['config']['database.connections'],
                  Config::get('fileserver::database.connections')
                  );

             include __DIR__.'/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
             $this->app['fileserver'] = $this->app->share(function($app) {
                       return new FileServer($this->app['config']);
                  });
             $this->app->booting(function() {
                       $loader = \Illuminate\Foundation\AliasLoader::getInstance();
                       $loader->alias('FileServer', 'Three\Fileserver\Facades\FileServer');
                  });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}

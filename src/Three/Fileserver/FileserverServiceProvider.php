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
         include __DIR__.'/../../routes.php';
         $this->loadViewsFrom(__DIR__.'/../../views', 'fileserver');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
             $this->app->register('Jenssegers\Mongodb\MongodbServiceProvider');
             $this->app['fileserver'] = $this->app->share(function($app) {
                       return new FileServer;
                  });

             $loader = \Illuminate\Foundation\AliasLoader::getInstance();
             $loader->alias('FileServer', 'Three\Fileserver\Facades\FileServer');
	}

	public function provides()
	{
         return [FileServer::class];
	}

}

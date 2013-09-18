<?php

namespace Socialism\LaravelOpauth;

use Illuminate\Support\ServiceProvider,
    \App,
    \URL;

/**
 * Class LaravelOpauthServiceProvider
 *
 * @property App $app
 * @package Socialism\LaravelOpauth
 */
class LaravelOpauthServiceProvider extends ServiceProvider {

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
		$this->package('socialism/laravel-opauth');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['opauth'] = $this->app->share(function (App $app) {
            $config = $app['config']->get("laravel-opauth::opauth");

            $config['security_salt'] = $app['config']->get('app.key');
            $config['path'] = substr(route($app['config']->get("laravel-opauth::route"), [null, null]), strlen(URL::to('/')));

            return new LaravelOpauth($config, false);
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('opauth');
	}

}
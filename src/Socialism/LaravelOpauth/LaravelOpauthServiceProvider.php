<?php

namespace Socialism\LaravelOpauth;

use Illuminate\Support\ServiceProvider,
    \Opauth,
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
        $this->app['opauth'] = $this->app->share(function ($app) {
            $config = $app['config']->get("laravel-opauth::opauth");
			$path = parse_url(route($app['config']->get("laravel-opauth::route"), [null, null]), PHP_URL_PATH);
			$path = rtrim($path, '/') . '/';

            $config['security_salt'] = $app['config']->get('app.key');
            $config['path'] = $path;

            return new Opauth($config, false);
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

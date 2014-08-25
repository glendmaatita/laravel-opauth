# Laravel 4.x [Opauth](http://opauth.org/) Package

### Installation:

Add to your `composer.json` in `require` section following line:

    "socialism/laravel-opauth": "0.1.*"

And run `composer update`, after that add the following line at the and of `app/config/app.php` `providers` section:

    'Socialism\LaravelOpauth\LaravelOpauthServiceProvider',


### Usage:

First of all define some route in your `app/routes.php` **it should be a named route**, like this:

```php
Route::any('auth/social/{strategy}/{action?}', ['as' => 'auth.social', function ($strategy, $action = 'request') {
    app('opauth')->run();
}])->where(['strategy' => '.*']);
```

Yes, route pattern must end up with `{strategy/{action?}`,
well, actually, `strategy` and `action` parameters can be named as you wish,
but the whole idea is that real URI MUST end up with something like that `facebook/callback` or `twitter`. And yes,
action parameter SHOULD be optional, if not your URI's MUST end up like this `google/request`.

**Note this `'as' => 'auth.social'` section**, again, route should be a named route, just for proper work.


### Configuration

Publish package config:

    php artisan config:publish socialism/laravel-opauth

So now you can configure route to be used and strategies in `app/config/packages/socialism/laravel-opauth/config.php`.

`route` key is about what URL actually accepts requests for opauth, it was noted in [Usage](#Usage) section.
`opauth` key is all about standard configuration described on
[official page](https://github.com/opauth/opauth/wiki/Opauth-configuration), except this keys:

 - `security_salt` will be setted automatically from `app.key` config.
 - `path` will also be generated automatically, actually for this config option package needs named route with such restrictions.

### Adding more strategies:

You are able to add any of the strategies which is all here: [List-of-strategies](https://github.com/opauth/opauth/wiki/List-of-strategies)

# Warning! Package will not work until you add at least one strategy to configuration file!

# Laravel HTML Response Cache Middleware

Provides caching of entire HTML responses in Laravel 5.

## Installation

Via Composer

```bash
$ composer require infusionweb/laravel-middleware-response-cache
```

## Laravel 5.1 Usage

### Add the service provider

```php
// within config/app.php

'providers' => [
    //
    \InfusionWeb\Laravel\Http\Middleware\ResponseCacheServiceProvider::class,
];
```

### Register as route middleware

```php
// within app/Http/Kernel.php

protected $routeMiddleware = [
    //
    'cachebefore' => \InfusionWeb\Laravel\Http\Middleware\ResponseCacheBeforeMiddleware::class,
    'cacheafter' => \InfusionWeb\Laravel\Http\Middleware\ResponseCacheAfterMiddleware::class,
    //
];
```

### Apply HTML response cache to routes

The following will cache the `gallery` route.

```php
// within app/Http/routes.php

Route::get('gallery', ['middleware' => ['cachebefore', 'cacheafter'], function () {
    return 'pictures!';
}]);
```

### Apply HTML response cache to controllers

The following will apply all default profiles to all methods within the `GalleryController`.

```php
// within app/Http/Controllers/GalleryController.php

public function __construct()
{
    $this->middleware(['cachebefore', 'cacheafter']);
}
```

## Laravel 5.2 Usage

Middleware can be registered the same as 5.1, or by the following method.

### Add to route middleware group

```php
// within app/Http/Kernel.php

protected $middlewareGroups = [
    'web' => [
        //
        'cachebefore' => \InfusionWeb\Laravel\Http\Middleware\ResponseCacheBeforeMiddleware::class,
        'cacheafter' => \InfusionWeb\Laravel\Http\Middleware\ResponseCacheAfterMiddleware::class,
        //
    ],
    //
];
```

### Apply HTML response cache to routes

All routes using the `web` middleware group will be cached.

```php
// within app/Http/routes.php

Route::group(['middleware' => ['web']], function () {
    Route::get('gallery', function () {
        return 'pictures!';
    });
});
```

## Enable and configure response caching

The middleware will only cache HTML responses when explicitly enabled. This is to allow development systems to operate normally by default, while easily allowing production systems to cache HTML responses.

### Publish the package config file

```bash
$ php artisan vendor:publish --provider="InfusionWeb\Laravel\Http\Middleware\ResponseCacheServiceProvider"
```

You may now enable response caching and change the default cache time by editing the `config/response-cache.php` file.

```php
return [
    'enable' => env('RESPONSE_CACHE_ENABLE', false),

    // Length of time to cache the HTML response, in minutes.
    'length' => env('RESPONSE_CACHE_LENGTH', 60),
];
```

## Credits

- [Russell Keppner](https://github.com/rkeppner)
- [All Contributors](https://github.com/InfusionWeb/laravel-middleware-response-cache/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

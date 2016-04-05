# Laravel HTML Response Cache Middleware

Provides caching of entire HTML responses in Laravel 5.

## Install

Via Composer

``` bash
$ composer require InfusionWeb/laravel-middleware-response-cache
```

## Usage

### Register as route middleware

``` php
// within app/Http/Kernal.php

protected $routeMiddleware = [
    //
    'cachebefore' => \InfusionWeb\Laravel\Http\Middleware\BeforeCacheMiddleware::class,
    'cacheafter' => \InfusionWeb\Laravel\Http\Middleware\AfterCacheMiddleware::class,
    //
];
```

### Apply HTML response cache to routes

The following will cache the `gallery` route.

``` php
// within app/Http/routes.php

Route::get('gallery', ['middleware' => ['cachebefore', 'cacheafter'], function () {
    return 'pictures!';
}]);
```

### Apply HTML response cache to controllers

The following will apply all default profiles to all methods within the `GalleryController`.

``` php
// within app/Http/Controllers/GalleryController.php

public function __construct()
{
    $this->middleware(['cachebefore', 'cacheafter']);
}
```

## Credits

- [Russell Keppner](https://github.com/rkeppner)
- [All Contributors](https://github.com/InfusionWeb/laravel-middleware-response-cache/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

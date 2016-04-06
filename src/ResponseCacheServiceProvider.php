<?php

namespace InfusionWeb\Laravel\Http\Middleware;

use Illuminate\Support\ServiceProvider;

class ResponseCacheServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/response-cache.php' => config_path('response-cache.php'),
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/response-cache.php', 'length'
        );
    }

}

<?php

namespace InfusionWeb\Laravel\Http\Middleware;

use Cache;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeforeCacheMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Only fire when explicitly enabled.
        if (getenv('CACHE_ROUTE') == true) {

            $request_uri = $request->url() . '?' . http_build_query($request->only('page'));

            $key = $this->keygen($request_uri);

            if (Cache::has($key)) {
                $content = Cache::get($key);

                return response($content);
            }

        }

        return $next($request);
    }

    /**
     * Generate cache key for route storage.
     *
     * @param string $url
     * @return string
     */
    protected function keygen($url)
    {
        return 'route_' . Str::slug($url);
    }
}

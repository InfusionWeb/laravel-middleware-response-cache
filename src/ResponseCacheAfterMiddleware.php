<?php

namespace InfusionWeb\Laravel\Http\Middleware;

use Cache;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResponseCacheAfterMiddleware
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
        $response = $next($request);

        // Only fire when explicitly enabled.
        if (config('RESPONSE_CACHE_ENABLE', false)) {

            $request_uri = $request->url() . '?' . http_build_query($request->only('page'));

            $key = 'route_' . Str::slug($request_uri);

            if (! Cache::has($key)) {
                Cache::put($key, $response->getContent(), config('RESPONSE_CACHE_LENGTH', 60));
            }

        }

        return $response;
    }
}

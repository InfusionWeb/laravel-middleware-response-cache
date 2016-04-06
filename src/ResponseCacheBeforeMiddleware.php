<?php

namespace InfusionWeb\Laravel\Http\Middleware;

use Cache;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResponseCacheBeforeMiddleware
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
        if (config('response-cache.enable', false)) {

            $request_uri = $request->url() . '?' . http_build_query($request->only('page'));

            $key = 'route_' . Str::slug($request_uri);

            if (Cache::has($key)) {
                $content = Cache::get($key);

                return response($content);
            }

        }

        return $next($request);
    }
}

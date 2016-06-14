<?php

namespace InfusionWeb\Laravel\Http\Middleware;

use Cache;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResponseCacheBeforeMiddleware extends ResponseCacheBaseMiddleware
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

            $key = $this->key($request);

            if (Cache::has($key)) {
                $content = Cache::get($key);

                return response($content);
            }

        }

        return $next($request);
    }
}

<?php

namespace InfusionWeb\Laravel\Http\Middleware;

use Cache;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResponseCacheAfterMiddleware extends ResponseCacheBaseMiddleware
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
        if (config('response-cache.enable', false)) {

            $key = $this->key($request);

            if (! Cache::has($key)) {
                Cache::put($key, $response->getContent(), config('response-cache.length', 60));
            }

        }

        return $response;
    }
}

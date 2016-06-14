<?php


namespace InfusionWeb\Laravel\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class ResponseCacheBaseMiddleware {

	/**
	 * Get cache key for the given request.
	 *
	 * @param Request $request
	 *
	 * @return string
	 */
	public static function key(Request $request) {
		$query = config('response-cache.query', false) ? $request->query() : $request->only('page');
		$request_uri = $request->url() . '?' . http_build_query($query);

		return 'route_' . Str::slug($request_uri);
	}

}
<?php

return [

    /*
     * Whether or not to enable HTML response caching. Off by default.
     */
    'enable' => env('RESPONSE_CACHE_ENABLE', false),

    /*
     * Length of time to cache the HTML response, in minutes.
     */
    'length' => env('RESPONSE_CACHE_LENGTH', 60),

	/*
     * Enable caching of queries.
     */
    'query' => env('RESPONSE_CACHE_QUERY', false),

];

<?php

return [
    /*
     * The base url used to for Food Data Central.
     *
     */
    'baseUri' => env('FOOD_DATA_CENTRAL_API_URI', 'https://api.nal.usda.gov/fdc'),

    /*
     * The API version provided by Food Data Central.
     *
     */
    'apiVersion' => env('FOOD_DATA_CENTRAL_API_VERSION', 'v1'),
    /*
     * The API Key provided by Food Data Central.
     * https://api.data.gov/signup/
     * https://fdc.nal.usda.gov/api-key-signup.html
     *
     */
    'apiKey' => env('FOOD_DATA_CENTRAL_API_KEY', null),
    /*
     * How long before the connection timeout.
     * Default is 10
     */
    'timeout' => env('FOOD_DATA_CENTRAL_API_TIMEOUT', 10),
    /*
     * The number of times a retry is allowed.
     * This is not used by default.
     */
    'retryTimes' => env('FOOD_DATA_CENTRAL_API_RETRY_TIMES', null),
    /*
     * The time between retry attempts in milliseconds.
     * This is not used by default.
     */
    'retryMilliseconds' => env('FOOD_DATA_CENTRAL_API_RETRY_DELAY', null),

    /*
     * The path to the migrations.
     */
    'includeMigrations' => env('FOOD_DATA_CENTRAL_API_INCLUDE_MIGRATIONS', false),

];

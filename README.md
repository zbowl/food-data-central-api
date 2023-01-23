# Food Data Central API Wrapper

This is a Laravel wrapper for the Food Data Central API. It is a work in progress.

## Config

Publish the configuration.
```bash
php artisan vendor:publish --provider="zbowl\FoodDataCentral\FoodDataCentralServiceProvider" --tag="config"
```
Add environment variables to your .env.
```bash
FOOD_DATA_CENTRAL_BASE_URI=
FOOD_DATA_CENTRAL_API_VERSION=
FOOD_DATA_CENTRAL_API_KEY=
FOOD_DATA_CENTRAL_API_TIMEOUT=
FOOD_DATA_CENTRAL_API_RETRY_TIMES=
FOOD_DATA_CENTRAL_API_RETRY_DELAY=
```
They will be used in the food-data-central config.
``` php
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
```


## Usage

``` php
use zbowl\FoodDataCentralApi\Facade\FoodDataCentral;

public function search(Request $request)
{
    $request->validate([
        'query' => 'required|string',
    ]);
    $searchTerm = $request->searchInput;
    
    $foodDataCentral = new FoodDataCentral();
    $results = $foodDataCentral::getFoodsSearch($searchTerm);
    
    return view('search', compact('results'));
}

{
    $foodDataCentral = FoodDataCentral::class;
    $results = $foodDataCentral::getFoodsSearch('apple');
    return $results;
}
```



#### Resources
- [Food Data Central API](https://fdc.nal.usda.gov/api-spec/fdc_api.html).
- [Data.gov](https://www.data.gov/developers/apis)

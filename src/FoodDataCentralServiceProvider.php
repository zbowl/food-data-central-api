<?php

namespace zbowl\FoodDataCentralApi;

use zbowl\FoodDataCentralApi\Api\Client;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class FoodDataCentralServiceProvider extends LaravelServiceProvider
{
    protected bool $defer = true;
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerFoodDataCentralClient();

        $this->mergeConfig();

        $this->app->alias(Client::class, 'food-data-central');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/config.php' => config_path('food-data-central.php')
            ], 'config');
        }
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerFoodDataCentralClient(): void
    {
        $this->app->singleton(Client::class, function () {
            return (new Client(
                baseUri: config('food-data-central.baseUri'),
                apiVersion: config('food-data-central.apiVersion'),
                apiKey: config('food-data-central.apiKey'),
                timeout: config('food-data-central.timeout'),
                retryTimes: config('food-data-central.retryTimes'),
                retryMilliseconds: config('food-data-central.retryMilliseconds'),
            ));
        });
    }

    /**
     * Merges user's and food data central's configs.
     *
     * @return void
     */
    private function mergeConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'food-data-central');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            Client::class,
            'food-data-central'
        ];
    }

}

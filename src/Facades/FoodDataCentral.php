<?php

namespace zbowl\FoodDataCentralApi\Facades;

use Illuminate\Support\Facades\Facade;

class FoodDataCentral extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'fooddatacentral';
    }
}

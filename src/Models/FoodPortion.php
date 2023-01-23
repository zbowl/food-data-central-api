<?php

namespace zbowl\FoodDataCentralApi\Models;

use zbowl\FoodDataCentralApi\Support\Model;

class FoodPortion extends Model
{

    protected $casts = [
        'id' => 'integer',
        'amount' => 'float',
        'dataPoints' => 'integer',
        'gramWeight' => 'float',
        'minYearAcquired' => 'integer',
        'modifier' => 'string',
        'portionDescription' => 'string',
        'sequenceNumber' => 'integer',
        'measureUnit' => MeasureUnit::class,
    ];


}

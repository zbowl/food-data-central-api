<?php

namespace zbowl\FoodDataCentralApi\Models;

use zbowl\FoodDataCentralApi\Support\Model;

class FoodNutrient extends Model
{

    protected $casts = [
        'id' => 'integer',
        'amount' => 'float',
        'dataPoints' => 'integer',
        'min' => 'float',
        'max' => 'float',
        'median' => 'float',
        'type' => 'string',
        'nutrient' => Nutrient::class,
        'foodNutrientDerivation' => FoodNutrientDerivation::class,
        'nutrientAnalysisDetails' => NutrientAnalysisDetails::class, //only present if FoundationFood is requested
    ];

}

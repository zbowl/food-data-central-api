<?php

namespace zbowl\FoodDataCentralApi\Models;

use zbowl\FoodDataCentralApi\Support\Model;

class FoodNutrientDerivation extends Model
{

    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'description' => 'string',
        'foodNutrientSource' => FoodNutrientSource::class,
    ];

}

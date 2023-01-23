<?php

namespace zbowl\FoodDataCentralApi\Models;

use zbowl\FoodDataCentralApi\Support\Model;

class NutrientConversionFactors extends Model
{

    protected $casts = [
        'type'  => 'string',
        'value' => 'float',
    ];

}

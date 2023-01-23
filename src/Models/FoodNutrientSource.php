<?php

namespace zbowl\FoodDataCentralApi\Models;

use zbowl\FoodDataCentralApi\Support\Model;

class FoodNutrientSource extends Model
{

    protected $casts = [
        'id' => 'integer',
        'code' => 'string',
        'description' => 'string',
    ];

}

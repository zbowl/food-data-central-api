<?php

namespace zbowl\FoodDataCentralApi\Models;

use zbowl\FoodDataCentralApi\Support\Model;

class Nutrient extends Model
{

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'number' => 'string',
        'rank' => 'integer',
        'unitName' => 'string',
    ];

}

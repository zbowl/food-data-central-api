<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class WweiaFoodCategory extends Model
{

    protected $casts = [
        'wweiaFoodCategoryCode'        => 'integer',
        'wweiaFoodCategoryDescription' => 'string',
    ];

}

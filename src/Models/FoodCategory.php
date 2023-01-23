<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class FoodCategory extends Model
{

    protected $casts = [
        'id'          => 'integer',
        'code'        => 'string',
        'description' => 'string',
    ];

}

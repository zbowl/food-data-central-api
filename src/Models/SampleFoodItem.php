<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class SampleFoodItem extends Model
{

    protected $casts = [
        'fdcId'           => 'integer',
        'datatype'        => 'string',
        'description'     => 'string',
        'foodClass'       => 'string',
        'publicationDate' => Carbon::class,
        'foodAttributes'  => FoodCategory::class,
    ];

}

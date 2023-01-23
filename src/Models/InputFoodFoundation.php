<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class InputFoodFoundation extends Model
{

    protected $casts = [
        'id'              => 'integer',
        'foodDescription' => 'integer',
        'inputFood'       => SampleFoodItem::class,

    ];

}

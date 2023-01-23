<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class FoodAttribute extends Model
{

    protected $casts = [
        'id'                => 'integer',
        'sequenceNumber'    => 'integer',
        'value'             => 'string',
        'foodAttributeType' => FoodAttributeType::class,

    ];

}

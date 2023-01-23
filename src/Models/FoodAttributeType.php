<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class FoodAttributeType extends Model
{

    protected $casts = [
        'id'          => 'integer',
        'name'        => 'string',
        'description' => 'string',

    ];

}

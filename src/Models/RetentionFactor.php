<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class RetentionFactor extends Model
{

    protected $casts = [
        'id'          => 'integer',
        'code'        => 'integer',
        'description' => 'string',
    ];

}

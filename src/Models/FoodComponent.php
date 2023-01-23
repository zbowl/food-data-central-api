<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class FoodComponent extends Model
{

    protected $casts = [
        'id'              => 'integer',
        'name'            => 'string',
        'dataPoints'      => 'string',
        'gramWeight'      => 'float',
        'isRefuse'        => 'boolean',
        'minYearAcquired' => 'integer',
        'percentWeight'   => 'float',
    ];

}

<?php

namespace zbowl\FoodDataCentralApi\Models;

use zbowl\FoodDataCentralApi\Support\Model;

class MeasureUnit extends Model
{

    protected $casts = [
        'id'           => 'integer',
        'abbreviation' => 'string',
        'name'         => 'integer',
    ];

}

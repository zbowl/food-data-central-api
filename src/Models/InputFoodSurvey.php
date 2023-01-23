<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class InputFoodSurvey extends Model
{

    protected $casts = [
        'id'                    => 'integer',
        'amount'                => 'float',
        'foodDescription'       => 'string',
        'ingredientCode'        => 'integer',
        'ingredientDescription' => 'string',
        'ingredientWeight'      => 'float',
        'portionCode'           => 'string',
        'portionDescription'    => 'string',
        'sequenceNumber'        => 'integer',
        'surveyFlag'            => 'integer',
        'unit'                  => 'string',
        //'inputFood' => InputFood::class,
        'retentionFactor'       => RetentionFactor::class,

    ];

}

<?php

namespace zbowl\FoodDataCentralApi\Models;

use zbowl\FoodDataCentralApi\Support\Model;

class AbridgedFoodNutrient extends Model
{

    protected $casts = [
        'nutrientId'                    => 'integer',
        'nutrientName'                  => 'string',
        'nutrientNumber'                => 'string',
        'unitName'                      => 'string',
        'derivationCode'                => 'string',
        'derivationDescription'         => 'string',
        'derivationId'                  => 'integer',
        'value'                         => 'float',
        'foodNutrientSourceId'          => 'integer',
        'foodNutrientSourceCode'        => 'string',
        'foodNutrientSourceDescription' => 'string',
        'rank'                          => 'integer',
        'indentLevel'                   => 'integer',
        'foodNutrientId'                => 'integer',
    ];

}

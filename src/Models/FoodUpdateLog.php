<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class FoodUpdateLog extends Model
{

    protected $casts = [
        'fdcId'                    => 'integer',
        'availableDate'            => Carbon::class,
        'brandOwner'               => 'string',
        'dataSource'               => 'string',
        'dataType'                 => 'string',
        'description'              => 'string',
        'foodClass'                => 'string',
        'gtinUpc'                  => 'string',
        'householdServingFullText' => 'string',
        'ingredients'              => 'string',
        'modifiedDate'             => Carbon::class,
        'publicationDate'          => Carbon::class,
        'servingSize'              => 'float',
        'servingSizeUnit'          => 'string',
        'brandedFoodCategory'      => 'string',
        'changes'                  => 'string',
        'foodAttributes'           => FoodAttribute::class,
    ];

}

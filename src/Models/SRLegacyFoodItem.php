<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use zbowl\FoodDataCentralApi\Support\Model;

class SRLegacyFoodItem extends Model
{

    protected $casts = [
        'fdcId'                     => 'integer',
        'dataType'                  => 'string',
        'description'               => 'string',
        'foodClass'                 => 'string',
        'footNote'                  => 'string',
        'isHistoricalReference'     => 'boolean',
        'ndbNumber'                 => 'string',
        'publicationDate'           => Carbon::class,
        'scientificName'            => 'string',
        'foodCategory'              => FoodCategory::class,
        'foodNutrients'             => FoodNutrient::class,
        'nutrientConversionFactors' => NutrientConversionFactors::class,
    ];

    public function setFoodNutrientsAttribute($attributes): FoodNutrient
    {
        //if its not associative array then we need to go through each item and create a new AbridgedFoodNutrient object
        if(!Arr::isAssoc($attributes)) {
            foreach ($attributes as $attribute) {
                return new FoodNutrient($attribute);
            }
        }

        return $attributes;
    }

}

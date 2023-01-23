<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use zbowl\FoodDataCentralApi\Support\Model;

class SearchResultFood extends Model
{
    protected $casts = [
        'fdcId'       => 'integer',
        'description' => 'string',
        'lowercaseDescription' => 'string',
        'dataType'    => 'string',
        'gtinUpc' => 'string',
        'publishedDate' => Carbon::class,
        'brandOwner' => 'string',
        'brandName' => 'string',
        'ingredients' => 'string',
        'marketCountry' => 'string',
        'foodCategory' => 'string',
        'modifiedDate' => Carbon::class,
        'dataSource' => 'string',
        'packageWeight' => 'string',
        'serviceSizeUnit' => 'string',
        'servingSize' => 'float',
        'householdServingFullText' => 'string',
        'shortDescription' => 'string',
        'tradeChannels' => 'array',
        'allHighlightFields' => 'string',
        'score' => 'float',
        'foodCode' => 'string',
        'foodNutrients' => AbridgedFoodNutrient::class
    ];

    public function setFoodNutrientsAttribute($attributes): AbridgedFoodNutrient
    {
        //if its not associative array then we need to go through each item and create a new AbridgedFoodNutrient object
        if(!Arr::isAssoc($attributes)) {
            foreach ($attributes as $attribute) {
                return new AbridgedFoodNutrient($attribute);
            }
        } else {
            return new AbridgedFoodNutrient($attributes);
        }
        return $attributes;
    }

}

<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use zbowl\FoodDataCentralApi\Support\Model;

class SurveyFoodItem extends Model
{

    protected $casts = [
        'fdcId'           => 'integer',
        'dataType'        => 'string',
        'description'     => 'string',
        'endDate'         => Carbon::class,
        'foodClass'       => 'string',
        'publicationDate' => Carbon::class,
        'startDate'       => Carbon::class,
        'foodAttributes'  => FoodAttribute::class,
        'foodPortions'    => FoodPortion::class,
        'inputFoods'      => InputFoodSurvey::class,
        'wweiaFoodCategory'   => WweiaFoodCategory::class,
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

<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use zbowl\FoodDataCentralApi\Support\Model;

class BrandedFoodItem extends Model
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
        'foodNutrients'            => FoodNutrient::class,
        'foodUpdateLog'            => FoodUpdateLog::class,
        'labelNutrients'           => LabelNutrient::class,
        'discontinuedDate'         => 'string',
        'foodComponents'           => 'array',
        'foodAttributes'           => 'array',
        'foodPortions'             => 'array',
        'marketCountry'            => 'string',
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

    public function setFoodUpdateLogAttribute($attributes): FoodUpdateLog
    {
        //if its not associative array then we need to go through each item and create a new AbridgedFoodNutrient object
        if(!Arr::isAssoc($attributes)) {
            foreach ($attributes as $attribute) {
                return new FoodUpdateLog($attribute);
            }
        }
        return $attributes;
    }

    public function setLabelNutrientsAttribute($attributes): LabelNutrient
    {
        $newAttributes = [];
        foreach($attributes as $key => $valueArray) {
            foreach($valueArray as $value) {
                $newAttributes[$key] = $value;
            }
        }
        return new LabelNutrient($newAttributes);
    }

}

<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use zbowl\FoodDataCentralApi\Support\Model;

class AbridgedFoodItem extends Model
{

    protected $casts = [
        'dataType'        => 'string',
        'description'     => 'string',
        'fdcId'           => 'integer',
        'foodNutrients'   => AbridgedFoodNutrient::class,
        'publicationDate' => Carbon::class,
        'brandOwner'      => 'string',
        'gtinUpc'         => 'string',
        'ndbNumber'       => 'string', //only applies to Foundation and SRLegacy Foods
        'foodCode'        => 'string',
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
        foreach ($attributes as $key => $valueArray) {
            foreach ($valueArray as $value) {
                $newAttributes[$key] = $value;
            }
        }

        return new LabelNutrient($newAttributes);
    }

}

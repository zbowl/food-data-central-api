<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use zbowl\FoodDataCentralApi\Support\Model;

class Food extends Model
{

    protected $casts = [
        'discontinuedDate'         => 'string',
        'foodComponents'           => 'array',
        'foodAttributes'           => 'array',
        'foodPortions'             => 'array',
        'fdcId'                    => 'integer',
        'description'              => 'string',
        'publicationDate'          => Carbon::class,
        'foodNutrients'            => FoodNutrient::class,
        'dataType'                 => 'string',
        'foodClass'                => 'string',
        'modifiedDate'             => Carbon::class,
        'availableDate'            => Carbon::class,
        'brandOwner'               => 'string',
        'dataSource'               => 'string',
        'brandedFoodCategory'      => 'string',
        'gtinUpc'                  => 'string',
        'householdServingFullText' => 'string',
        'ingredients'              => 'string',
        'marketCountry'            => 'string',
        'servingSize'              => 'float',
        'servingSizeUnit'          => 'string',
        'foodUpdateLog'            => FoodUpdateLog::class,
        'labelNutrients'           => LabelNutrient::class,

    ];



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

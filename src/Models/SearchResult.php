<?php

namespace zbowl\FoodDataCentralApi\Models;

use Illuminate\Support\Arr;
use zbowl\FoodDataCentralApi\Support\Model;

class SearchResult extends Model
{

    protected $casts = [
        'totalHits'           => 'integer',
        'currentPage'         => 'integer',
        'totalPages'          => 'integer',
        'pageList'            => 'array',
        'foodSearchCriteria'  => FoodSearchCriteria::class,
        'foods'               => SearchResultFood::class,
        'finalFoodInputFoods' => 'array',
        'foodMeasures'        => 'array',
        'foodAttributes'      => 'array',
        'foodAttributeTypes'  => 'array',
        'foodVersionIds'      => 'array',
    ];

    public function setFoodsAttribute($attributes): SearchResultFood
    {
        //if its not associative array then we need to go through each item and create a new AbridgedFoodNutrient object
        if(!Arr::isAssoc($attributes)) {
            foreach ($attributes as $attribute) {
                return new SearchResultFood($attribute);
            }
        } else {
            return new SearchResultFood($attributes);
        }

        return $attributes;
    }

}

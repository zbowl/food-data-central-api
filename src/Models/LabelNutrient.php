<?php

namespace zbowl\FoodDataCentralApi\Models;

use zbowl\FoodDataCentralApi\Support\Model;

class LabelNutrient extends Model
{

    protected $casts = [
        'fat' => 'float',
        'saturatedFat' => 'float',
        'transFat' => 'float',
        'cholesterol' => 'float',
        'sodium' => 'float',
        'carbohydrate' => 'float',
        'fiber' => 'float',
        'sugar' => 'float',
        'protein' => 'float',
        'vitaminA' => 'float',
        'vitaminC' => 'float',
        'calcium' => 'float',
        'iron' => 'float',
        'potassium' => 'float',
        'calories' => 'float',
        ];

}

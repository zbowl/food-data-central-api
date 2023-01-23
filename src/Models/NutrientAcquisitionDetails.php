<?php

namespace zbowl\FoodDataCentralApi\Models;

use zbowl\FoodDataCentralApi\Support\Model;

class NutrientAcquisitionDetails extends Model
{

    protected $casts = [
        'sampleUnitId' => 'integer',
        'purchaseDate' => 'string',
        'storeCity' => 'string',
        'storeState' => 'integer',
    ];

}

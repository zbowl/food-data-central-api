<?php

namespace zbowl\FoodDataCentralApi\Models;

use zbowl\FoodDataCentralApi\Support\Model;

class NutrientAnalysisDetails extends Model
{

    protected $casts = [
        'subSampleId'                => 'integer',
        'amount'                     => 'float',
        'nutrientId'                 => 'integer',
        'labMethodDescription'       => 'integer',
        'labMethodLink'              => 'string',
        'labMethodTechnique'         => 'string',
        'nutrientAcquisitionDetails' => NutrientAcquisitionDetails::class,
    ];

}

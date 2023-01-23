<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class FoodListCriteria extends Model
{
    /*
     * JSON for request body of 'list' POST request
     *
     */
    protected $casts = [
        'dataType' => 'array', //Required. Array of data types to include in the search. Enum: [ Branded, Foundation, SR Legacy, Survey (FNDDS) ]
        'pageSize'    => 'integer', //Optional. Number of results to return per page. Default is 10. Max is 50.
        'pageNumber' => 'integer', //Optional. Page number of results to return. Default is 1.
        'sortBy' => 'string', //Optional. Field to sort by. Enum: [ dataType.keyword, fdcId, publishedDate, lowercaseDescription.keyword ]
        'sortOrder' => 'string', //Optional. Sort order. Enum: [ asc, desc ]
    ];

}

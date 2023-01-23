<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class FoodSearchCriteria extends Model
{
    // 'query'        //Search terms to use in the search. The string may also include standard search operators
    // 'dataType'     //Optional. Filter on a specific data type; specify one or more values in an array.
    // 'pageSize'     //Optional. Maximum number of results to return for the current page. Default is 50.
    // 'pageNumber'   //Optional. Page number to retrieve. The offset into the overall result set is expressed as (pageNumber * pageSize)
    // 'sortBy'       //Optional. Specify one of the possible values to sort by that field. Note, dataType.keyword will be dataType and description.keyword will be description in future releases.
    // 'sortOrder'    //Optional. The sort direction for the results. Only applicable if sortBy is specified.
    // 'brandOwner'   //Optional. Filter results based on the brand owner of the food. Only applies to Branded Foods.
    // 'tradeChannel' //Optional. Filter foods containing any of the specified trade channels.
    // 'startDate'    //Filter foods published on or after this date. Format: YYYY-MM-DD
    // 'endDate'      //Filter foods published on or before this date. Format: YYYY-MM-DD

    /*
     * JSON for request body of 'search' POST request
     *
     */
    protected $casts = [
        'query'        => 'string', //Required. Search terms to use in the search. The string may also include standard search operators
        'dataType'     => 'array', //Required. Array of data types to include in the search. Enum: [ Branded, Foundation, SR Legacy, Survey (FNDDS) ]
        'pageSize'     => 'integer', //Optional. Number of results to return per page. Default is 10. Max is 50.
        'pageNumber'   => 'integer', //Optional. Page number of results to return. Default is 1.
        'sortBy'       => 'string', //Optional. Field to sort by. Enum: [ dataType.keyword, fdcId, publishedDate, lowercaseDescription.keyword ]
        'sortOrder'    => 'string', //Optional. Sort order. Enum: [ asc, desc ]
        'brandOwner'   => 'string', //Optional. Filter results based on the brand owner of the food. Only applies to Branded Foods.
        'tradeChannel' => 'string', //Optional. Filter foods containing any of the specified trade channels.
        'startDate'    => Carbon::class, //Optional. Filter foods published on or after this date. Format: YYYY-MM-DD
        'endDate'      => Carbon::class, //Optional. Filter foods published on or before this date. Format: YYYY-MM-DD
        'generalSearchInput' => 'string', //Optional. Search terms to use in the search. The string may also include standard search operators
        'numberOfResultsPerPage' => 'integer', //Optional. Number of results to return per page. Default is 10. Max is 50.
        'requireAllWords' => 'boolean', //Optional. If true, only foods that contain all search terms will be returned. If false, foods that contain any of the search terms will be returned. Default is false.
        'foodTypes' => 'array' //Optional. Filter foods containing any of the specified food types.
    ];

}

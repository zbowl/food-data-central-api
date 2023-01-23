<?php

namespace zbowl\FoodDataCentralApi\Models;

use Carbon\Carbon;
use zbowl\FoodDataCentralApi\Support\Model;

class FoodsCriteria extends Model
{
    /*
     * JSON for request body of 'foods' POST request. Retrieves a list of food items by a list of up to 20 FDC IDs.
     * Optional format and nutrients can be specified.
     * Invalid FDC ID's or ones that are not found are omitted and an empty set is returned if there are no matches.
     *
     *
     */
    protected $casts = [
        'fdcIds'    => 'array',
        'format'    => 'string', //Optional. 'abridged' for an abridged set of elements, 'full' for all elements (default). Enum: [ abridged, full ]
        'nutrients' => 'array',
    ];

}

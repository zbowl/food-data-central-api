<?php

namespace zbowl\FoodDataCentralApi\Traits;


trait Foods
{
    use Search;
    //TODO: Invalid FDC ID's or ones that are not found are omitted and an empty set is returned if there are no matches.
    //      If the FDC ID is not found, the response will be an empty array.
    //      We should probably throw an exception if the FDC ID is not found.
    //      One way to do this is to check the response body for an empty array and throw an exception if it is.
    //      Another way is to check the response status code for 404 and throw an exception if it is.
    //      Another way is to check the response status code for 200 and throw an exception if it is not.
    //      Another way is to compare the response with the list of FDC ID's that were passed in and throw an exception if they do not match.
    //
    public string|array $nutrients;

    /**
     * Get a list of foods by Food Data Central ID (fdcId) by GET request.
     * Max of 20 fdcIds per request.
     *
     * @param  array        $fdcIdList
     * @param  string|null  $format
     * @param  array|null   $nutrients
     *
     * @return array
     */
    public function getFoods(array $fdcIdList = [], ?string $format = 'full', ?array $nutrients = []): array
    {
        $this->apiEndPoint = 'foods';

        $this->query = http_build_query([
            'fdcIds' => implode(',', $fdcIdList),
            'format' => $format,
            'nutrients' => implode(',', $nutrients),
        ]);

        $this->verb = 'get';

        return $this->executeRequest();
    }
    /**
     * Get a specific Food from Food Data Central ID (fdcId) by GET request.
     *
     * @param  string       $fdcId
     * @param  string|null  $format
     * @param  array|null   $nutrients
     *
     * @return array
     */
    public function getFood(string $fdcId, ?string $format = 'full', ?array $nutrients = []): array
    {
        $this->apiEndPoint = "food/{$fdcId}";

        $this->verb = 'get';

        return $this->executeRequest();
    }

    /**
     * Get a list of foods by Food Data Central ID (fdcId) by POST request.
     * Max of 20 fdcIds per request.
     *
     * @param  array  $fdcIdList
     *
     * @return array
     */
    public function postFoods(array $fdcIdList = [], ?string $format = 'full', ?array $nutrients = []): string
    {
        $this->apiEndPoint = 'foods';

        $this->hasBody = true;

        $this->body = json_encode([
            'fdcIds' => $fdcIdList,
            'format' => $format,
        ]);

        $this->verb = 'post';

        return $this->executeRequest();
    }

}

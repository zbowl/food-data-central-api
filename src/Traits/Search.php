<?php

namespace zbowl\FoodDataCentralApi\Traits;

use zbowl\FoodDataCentralApi\Models\SearchResult;

trait Search
{
    public function getFoodsSearch(
        string $searchTerm,
        string|array $dataType = 'Branded',
        int $pageSize = 25,
        int $pageNumber = 1,
        string $sortBy = 'lowercaseDescription.keyword',
        string $sortOrder = 'asc',
        string $brandOwner = '',
    ): string {
        $this->apiEndPoint = 'foods/search';

        $this->query = http_build_query([
            'query'      => $searchTerm,
            'dataType'   => $dataType,
            'pageSize'   => $pageSize,
            'pageNumber' => $pageNumber,
            'sortBy'     => $sortBy,
            'sortOrder'  => $sortOrder,
            'brandOwner' => $brandOwner,
        ]);

        $this->verb = 'get';

        $response = $this->executeRequest();

        $searchResult = new SearchResult($response);
        dd($searchResult);
        return new SearchResult($response);
    }

    /**
     * Search for foods by POST request.
     * However this does not work for some reason.
     *
     * @param  array  $searchOptions
     *
     * @return array
     */
    public function postFoodsSearch(
        string $searchTerm,
        string|array $dataType = 'Branded',
        string|array $brandOwner = '',
        int $pageSize = 25,
        int $pageNumber = 1,
        string|array $sortBy = 'lowercaseDescription.keyword',
        string|array $sortOrder = 'asc',
    ): array {
        $this->apiEndPoint = 'foods/search';
        //$this->buildSearchOptions($searchTerm, $dataType, $pageSize, $pageNumber, $sortBy, $sortOrder, $brandOwner, $tradeChannel, $startDate, $endDate);

        $this->buildBody([
            'query'      => $searchTerm,
            'dataType'   => $dataType,
            'pageSize'   => $pageSize,
            'pageNumber' => $pageNumber,
            'sortBy'     => $sortBy,
            'sortOrder'  => $sortOrder,
            'brandOwner' => $brandOwner
        ]);

        $this->verb = 'post';

        return $this->executeRequest();
    }
}

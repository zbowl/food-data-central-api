<?php

namespace zbowl\FoodDataCentralApi\Api;

use Illuminate\Http\Client\Response;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use zbowl\FoodDataCentralApi\Traits\Foods;
use zbowl\FoodDataCentralApi\Traits\Search;

class Client
{
    use Foods;
    use Search;


    private PendingRequest $pendingRequest;
    protected string $verb = 'post';
    protected string $apiEndPoint;
    protected string $apiUrl;
    protected string $query;
    protected array|string $body;
    protected bool $hasBody = false;
    public function __construct(
        public string $baseUri,
        public string $apiVersion,
        public string $apiKey,
        public int $timeout,
        public null|int $retryTimes,
        public null|int $retryMilliseconds,
    ) {
        $this->buildRequestClient();
    }

    /**
     * Build our default Request
     *
     */
    private function buildRequestClient(): void
    {
        $request = Http::withHeaders([
            'Accept' => 'application/json',
            'X-Api-Key' => $this->apiKey,
        ])->timeout(
            seconds: $this->timeout,
        );

        if(!is_null($this->retryTimes) && !is_null($this->retryMilliseconds)) {
            $request->retry(
                times: (int)$this->retryTimes,
                sleepMilliseconds: (int)$this->retryMilliseconds,
            );
        }
        $this->pendingRequest = $request;
    }

    /**
     * Prepare Food Data Central API request & return response.
     *
     * @return mixed
     */
    private function makeHttpRequest(): mixed
    {
        try {
            if(isset($this->query)) {
                return $this->pendingRequest->{$this->verb}(
                    url: $this->apiUrl,
                    query: $this->query ?? null,
                );
            } else {
                return $this->pendingRequest->{$this->verb}(
                    url: $this->apiUrl
                );
            }

        } catch (HttpClientException $e) {
            throw new RuntimeException($e->getCode().': '.$e->getMessage());
        }
    }

    /**
     * Create the full url for request.
     *
     * @return void
     */
    public function setUrl(): void
    {
        $this->apiUrl = collect([$this->baseUri, $this->apiVersion, $this->apiEndPoint])->implode('/');
    }

    /**
     * Execute Food Data Central API request & return response.
     *
     * @return mixed
     */
    protected function executeRequest(): mixed
    {
        try {
            $this->setUrl();

            if($this->hasBody)
            {
                $this->pendingRequest->withBody($this->body, 'application/json');
            }

            //dd($this);
            //dd(json_decode($this->body, true), $this);
            $response = $this->makeHttpRequest();

            if($response->successful()) {
                $processedResponse = $this->processResponse($response);
                return $processedResponse;
            } else {
                throw new RuntimeException($response->status().': '.$response->body());
            }
        }catch (RuntimeException $t){
            $message = collect($t->getMessage())->implode('\n');
        }

        return [
            'type'    => 'error',
            'message' => $message,
        ];
    }

    protected function processResponse(Response $response): array
    {
        //dd($response);
        //dd($response->json());
        //dd($foods);

        return $response->json();

        /*return match (true)
        {
            isset($response->json()[0]) => new Food($response->json()[0]),
            isset($response->json()['foods']) => new SearchResultFood($response->json()['foods']),
            default => $response->toArray(),
        };*/
    }

    protected function buildBody(string|array $body): void
    {
        $this->body = match(true)
        {
            empty($body) => '',
            is_array($body) => json_encode($body),
            default => $body,
        };

        $this->hasBody = true;
    }

    public function getDocumentation(string $specification = 'json'): array
    {
        match(true)
        {
            $specification === 'yaml' => $this->getDocumentationInYaml(),
            default => $this->getDocumentationInJson(),
        };

        return $this->executeRequest();
    }
    protected function getDocumentationInJson()
    {
        $this->apiEndPoint = 'json-spec';
        $this->verb = 'get';
        $this->hasBody = false;

        return $this->executeRequest();
    }

    protected function getDocumentationInYaml()
    {
        $this->apiEndPoint = 'yaml-spec';
        $this->verb = 'get';
        $this->hasBody = false;

        return $this->executeRequest();
    }

}

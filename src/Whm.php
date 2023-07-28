<?php

namespace Ouchestechnology\WhmPhp;

class WhmPhp
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct($baseUrl, $apiKey)
    {
        $this->baseUrl = $baseUrl;
        $this->apiKey = $apiKey;
    }

    protected function makeRequest($endpoint, $params = [], $method = 'GET')
    {
        $client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'whm ' . $this->apiKey,
                'Accept' => 'application/json',
            ],
        ]);

        $response = $client->request($method, $endpoint, ['query' => $params]);
        return json_decode($response->getBody()->getContents(), true);
    }


}
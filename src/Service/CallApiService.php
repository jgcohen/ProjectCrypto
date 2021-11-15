<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    public function getData(): array
{
    $response = $this->client->request(
        'GET',
        'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest',
        ['headers' => [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: 2e36d0ab-fd40-4059-9b49-97ab20b4bc3c'
          ]]
    );
    return $response->toArray();
}}
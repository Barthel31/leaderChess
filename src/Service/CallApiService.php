<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    
    public function getPlayer(): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.chess.com/pub/player/La_taupe'
        );
        return $response->toArray();
    }

    public function getStatisticPlayer(): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.chess.com/pub/player/La_taupe/stats'
        );
        return $response->toArray();
    }
}
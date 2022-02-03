<?php

namespace App\Service;

use App\Repository\PlayerRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private HttpClientInterface $client;
    private PlayerRepository $playerRepository;

    public function __construct(HttpClientInterface $client, PlayerRepository $playerRepository)
    {
        $this->client = $client;
        $this->playerRepository = $playerRepository;
    }
    
    public function getPlayers(): array
    {
        $players = $this->playerRepository->findAll();
        $nicknames = [];
        for ($i = 0; $i < count($players); $i++) {
            $nicknames[] = $players[$i]->getNickname();
        }
        foreach ($nicknames as $nickname) {
            $response = $this->client->request(
                'GET',
                'https://api.chess.com/pub/player/' . $nickname 
            );
            $response2 = $this->client->request(
                'GET',
                'https://api.chess.com/pub/player/' . $nickname . '/stats'
            );
            $responses[] = [
                $response->toArray(),
                $response2->toArray(),
            ];  
            
        }
        return $responses;       
    }

    public function getOnePlayer(string $nickname): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.chess.com/pub/player/' . $nickname 
        );
        $response2 = $this->client->request(
            'GET',
            'https://api.chess.com/pub/player/' . $nickname . '/stats'
        );
        $responses[] = [
            $response->toArray(),
            $response2->toArray(),
        ];

        return $responses;
    }
}
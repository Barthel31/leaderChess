<?php

namespace App\Service;

use App\Repository\PlayerRepository;
use App\Repository\UserRepository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private HttpClientInterface $client;
    private UserRepository $userRepository;

    public function __construct(HttpClientInterface $client, UserRepository $userRepository)
    {
        $this->client = $client;
        $this->userRepository = $userRepository;
    }
    
    public function getPlayers(): array
    {
        $players = $this->userRepository->findAll();
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
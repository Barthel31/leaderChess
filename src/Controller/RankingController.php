<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ranking", name="ranking_")
 */
class RankingController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(CallApiService $callApiService): Response
    {
        return $this->render('ranking/index.html.twig', [
            'players' => $callApiService->getPlayers(),
        ]);
    }

    /**
     * @Route("/{nickname}", name="show")
     */
    public function playerProfil(string $nickname, CallApiService $callApiService): Response
    {   
        return $this->render('ranking/show.html.twig', [
            'player' => $callApiService->getOnePlayer($nickname),
        ]);
    }
}

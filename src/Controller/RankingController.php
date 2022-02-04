<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="ranking_")
 */
class RankingController extends AbstractController
{
    /**
     * @Route("/", name="blitz")
     */
    public function rankingBlitz(CallApiService $callApiService): Response
    {
        return $this->render('ranking/index.html.twig', [
            'players' => $callApiService->getPlayers(),
        ]);
    }

    /**
     * @Route("/bullet", name="bullet")
     */
    public function rankingBullet(CallApiService $callApiService): Response
    {
        return $this->render('ranking/bullet.html.twig', [
            'players' => $callApiService->getPlayers(),
        ]);
    }

    /**
     * @Route("/rapid", name="rapid")
     */
    public function rankingRapid(CallApiService $callApiService): Response
    {
        return $this->render('ranking/rapid.html.twig', [
            'players' => $callApiService->getPlayers(),
        ]);
    }

    /**
     * @Route("/individual/{nickname}", name="show")
     */
    public function playerProfil(string $nickname, CallApiService $callApiService): Response
    {   
        return $this->render('ranking/show.html.twig', [
            'player' => $callApiService->getOnePlayer($nickname),
        ]);
    }
}

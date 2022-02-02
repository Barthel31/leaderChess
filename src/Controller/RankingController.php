<?php

namespace App\Controller;

use App\Service\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RankingController extends AbstractController
{
    /**
     * @Route("/ranking", name="ranking")
     */
    public function index(CallApiService $callApiService): Response
    {
        return $this->render('ranking/index.html.twig', [
            'player' => $callApiService->getPlayer(),
            'playerStatistic' => $callApiService->getStatisticPlayer(),
        ]);
    }
}

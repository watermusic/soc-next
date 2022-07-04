<?php

namespace App\Controller;

use App\Provider\KickerProvider;
use App\Repository\PlayerRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    private KickerProvider $kickerProvider;

    private PlayerRepository $playerRepository;

    public function __construct(KickerProvider $kickerProvider, PlayerRepository $playerRepository)
    {
        $this->kickerProvider = $kickerProvider;

        $this->playerRepository = $playerRepository;
    }

    /**
     * @throws Exception
     */
    #[Route('/game/dashboard', name: 'app_game_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('game/dashboard.html.twig', [
            'news' => $this->kickerProvider->getNewsAsArray(),
        ]);
    }

    #[Route('/game/team', name: 'app_game_team')]
    public function team(): Response
    {
        $user = $this->getUser();

        $players = $this->playerRepository->findByUser($user);

        return $this->render('game/team.html.twig', [
            'players' => $players,
        ]);
    }

    #[Route('/game/lineup', name: 'app_game_lineup')]
    public function lineup(): Response
    {
        return $this->render('game/team.html.twig', [
        ]);
    }

    #[Route('/game/standings', name: 'app_game_standings')]
    public function standings(): Response
    {
        return $this->render('game/team.html.twig', [
        ]);
    }
}

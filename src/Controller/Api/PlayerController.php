<?php

namespace App\Controller\Api;

use App\Repository\PlayerRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PlayerController extends AbstractController
{
    private PlayerRepository $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    /**
     * @throws Exception
     */
    #[Route('/api/players', name: 'api_players')]
    public function index(): Response
    {
        $result = [];
        $players = $this->playerRepository->findByUser($this->getUser());

        foreach ($players as $player) {
            $result[] = [
                "id" => $player->getId(),
                "name" => $player->getName(),
                "img" => $player->getPublicThumbUrl(),
                "state" => "bench",
                "state_num" => null,
                "position" => [
                    "shortcut" => $player->getPosition()->getShortcut(),
                    "name" => $player->getPosition()->getName(),
                    "id" => $player->getPosition()->getId(),
                ],
                "team" => [
                    "id" => $player->getTeam()->getId(),
                    "img" => $player->getTeam()->getPublicThumbUrl(),
                    "name" => $player->getTeam()->getName(),
                ],
            ];
        }

        return new JsonResponse($result);
    }
}

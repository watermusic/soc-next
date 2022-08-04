<?php

namespace App\Controller\Api;

use App\Entity\Lineup;
use App\Repository\LineupRepository;
use App\Repository\PlayerRepository;
use DateTimeImmutable;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use JsonException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class LineUpController extends AbstractController
{
    protected ManagerRegistry $doctrine;
    private LineupRepository $lineupRepository;

    public function __construct(ManagerRegistry $doctrine, LineupRepository $lineupRepository)
    {
        $this->doctrine = $doctrine;
        $this->lineupRepository = $lineupRepository;
    }

    /**
     * @throws Exception
     */
    #[Route('/api/lineups', name: 'api_lineups_show', methods: ['GET'])]
    public function index(): Response
    {
        $result = [];
        $lineUps = $this->lineupRepository->findByUser($this->getUser());

        foreach ($lineUps as $lineUp) {
            $result[] = $lineUp->serialize();
        }

        return new JsonResponse($result);
    }

    /**
     * @throws NonUniqueResultException
     * @throws JsonException
     */
    #[Route('/api/lineups', name: 'api_lineups_store', methods: ['POST'])]
    public function store(Request $request): Response
    {
        $attributes = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $lineUp = $this->lineupRepository->findByUserAndMatchday($this->getUser(), $attributes['matchday']);

        if (! $lineUp) {
            $lineUp = new Lineup();
            $lineUp->setCreatedAt(new DateTimeImmutable());
        }

        $lineUp->setMatchday($attributes['matchday']);
        $lineUp->setData($attributes['data']);
        $lineUp->setUpdatedAt(new DateTimeImmutable());
        $lineUp->setUser($this->getUser());

        $om = $this->doctrine->getManager();
        $om->persist($lineUp);
        $om->flush();

        return new JsonResponse($lineUp->serialize());
    }
}

<?php

namespace App\Controller\Api;

use App\Provider\KickerProvider;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class NewsController extends AbstractController
{
    private KickerProvider $kickerProvider;

    public function __construct(KickerProvider $kickerProvider)
    {
        $this->kickerProvider = $kickerProvider;
    }

    /**
     * @throws Exception
     */
    #[Route('/api/news', name: 'api_news')]
    public function index(): Response
    {
        return new JsonResponse(['news' => $this->kickerProvider->getNewsAsArray()]);
    }
}

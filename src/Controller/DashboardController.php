<?php

namespace App\Controller;

use App\Provider\KickerProvider;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    private KickerProvider $kickerProvider;

    public function __construct(KickerProvider $kickerProvider)
    {
        $this->kickerProvider = $kickerProvider;
    }

    /**
     * @throws Exception
     */
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {


        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            'news' => $this->kickerProvider->getNewsAsArray()
        ]);
    }
}

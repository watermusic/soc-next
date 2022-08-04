<?php

namespace App\Controller;

use App\Entity\Lineup;
use App\Entity\Player;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LineupController extends AbstractController
{
    protected ManagerRegistry $doctrine;

    protected Pdf $knpSnappyPdf;

    public function __construct(ManagerRegistry $doctrine, Pdf $knpSnappyPdf)
    {
        $this->doctrine = $doctrine;

        $this->knpSnappyPdf = $knpSnappyPdf;
    }


    #[Route(
        path: '/lineup/{matchday}/print.{_format}',
        name: 'app_lineup_print',
        requirements: [
            '_format' => 'html|pdf',
        ],
        methods: ['GET'],
        format: 'html',
    )]
    public function print($matchday, $_format): Response
    {
        $om = $this->doctrine->getManager();

        $userRepository = $om->getRepository(User::class);
        $playerRepository = $om->getRepository(Player::class);
        $lineupRepository = $om->getRepository(Lineup::class);

        $users = $userRepository->findAll();
        $lineups = [];

        foreach ($users as $user) {
            $lineups[$user->getName()] = [];
            $lineup = $lineupRepository->findByUserAndMatchday($user, $matchday);

            $lineups[$user->getName()]['players'] = [];
            $lineups[$user->getName()]['lineup'] = $lineup;

            if($lineup === null) {
                continue;
            }

            foreach ($lineup->getData() as $position) {
                $player = $playerRepository->find($position['id_player']);
                $lineups[$user->getName()]['players'][$position['num']] = $player;
            }

            ksort($lineups[$user->getName()]['players']);
        }

        $html = $this->renderView('lineup/print.html.twig', [
            'title' => sprintf('%s. Spieltag ausdrucken', $matchday),
            'lineups' => $lineups,
            'matchday' => $matchday,
        ]);

        if($_format === "html") {
            return new Response($html);
        }

        $pageUrl = $this->generateUrl('app_lineup_print', ['matchday' => $matchday, '_format' => 'html'], UrlGeneratorInterface::ABSOLUTE_URL);

        return new PdfResponse(
            $this->knpSnappyPdf->getOutput($pageUrl, [
                'orientation' => 'Landscape',
                'margin-bottom' => 0,
                'margin-left' => 0,
                'margin-right' => 0,
                'margin-top' => 0,
            ]),
            sprintf('%s_spieltag', $matchday)
        );
    }
}

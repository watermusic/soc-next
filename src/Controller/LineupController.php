<?php

namespace App\Controller;

use App\Entity\Lineup;
use App\Entity\Player;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use JsonException;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class LineupController extends AbstractController
{
    protected const POSITION_GOALKEEPER = 'GOALKEEPER';
    protected const POSITION_FORWARD = 'FORWARD';
    protected const POSITION_MIDFIELDER = 'MIDFIELDER';
    protected const POSITION_DEFENDER = 'DEFENDER';

    protected ManagerRegistry $doctrine;

    protected Pdf $knpSnappyPdf;

    protected string $projectDir;

    public function __construct(
        ManagerRegistry $doctrine,
        Pdf             $knpSnappyPdf,
        #[Autowire('%kernel.project_dir%')]
        string          $projectDir,
    )
    {
        $this->doctrine = $doctrine;

        $this->knpSnappyPdf = $knpSnappyPdf;

        $this->projectDir = $projectDir;
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

            if ($lineup === null) {
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

        if ($_format === "html") {
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

    /**
     * @throws JsonException
     */
    #[Route(
        path: '/transfers/print.{_format}',
        name: 'app_transfers_print',
        requirements: [
            '_format' => 'html|pdf',
        ],
        methods: ['GET'],
        format: 'html',
    )]
    public function printTransfers($_format): Response
    {
        $pageUrl = $this->generateUrl('app_transfers_print', ['_format' => 'html'], UrlGeneratorInterface::ABSOLUTE_URL);

        $database = json_decode(file_get_contents($this->projectDir . '/var/storage/players.json'), true, 512, JSON_THROW_ON_ERROR);
        $teams = [];

        $players = [
            static::POSITION_GOALKEEPER => [],
            static::POSITION_DEFENDER => [],
            static::POSITION_MIDFIELDER => [],
            static::POSITION_FORWARD => [],
        ];

        foreach ($database['teams'] as $team) {
            $teams[$team['id']] = $team;
        }

        foreach ($database['players'] as $transfer) {
            if ($transfer['position'] === static::POSITION_GOALKEEPER) {
                $players[static::POSITION_GOALKEEPER][] = $transfer;
            }

            if ($transfer['position'] === static::POSITION_DEFENDER) {
                $players[static::POSITION_DEFENDER][] = $transfer;
            }

            if ($transfer['position'] === static::POSITION_MIDFIELDER) {
                $players[static::POSITION_MIDFIELDER][] = $transfer;
            }

            if ($transfer['position'] === static::POSITION_FORWARD) {
                $players[static::POSITION_FORWARD][] = $transfer;
            }
        }

        $players[static::POSITION_GOALKEEPER] = array_chunk(array_values($this->array_sort($players[static::POSITION_GOALKEEPER], 'marketValue', SORT_DESC)), 47);
        $players[static::POSITION_DEFENDER] = array_chunk(array_values($this->array_sort($players[static::POSITION_DEFENDER], 'marketValue', SORT_DESC)), 47);
        $players[static::POSITION_MIDFIELDER] = array_chunk(array_values($this->array_sort($players[static::POSITION_MIDFIELDER], 'marketValue', SORT_DESC)), 47);
        $players[static::POSITION_FORWARD] = array_chunk(array_values($this->array_sort($players[static::POSITION_FORWARD], 'marketValue', SORT_DESC)), 47);

        $html = $this->renderView('lineup/transfers.html.twig', [
            'title' => 'Spieler Liste',
            'players' => $players,
            'teams' => $teams,
        ]);

        if ($_format === "html") {
            return new Response($html);
        }

        return new PdfResponse(
            $this->knpSnappyPdf->getOutput($pageUrl, [
                'orientation' => 'Portrait',
                'margin-bottom' => 0,
                'margin-left' => 0,
                'margin-right' => 0,
                'margin-top' => 0,
            ]),
            'transferMarket.pdf'
        );
    }

    private function array_sort(array $array, string $on, int $order = SORT_ASC): array
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 === $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }
}

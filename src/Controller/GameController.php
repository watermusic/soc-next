<?php /** @noinspection ALL */

namespace App\Controller;

use App\Provider\KickerProvider;
use App\Repository\PlayerRepository;
use App\Repository\ScoreRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class GameController extends AbstractController
{
    private KickerProvider $kickerProvider;

    private PlayerRepository $playerRepository;

    private ScoreRepository $scoreRepository;

    private ChartBuilderInterface $chartBuilder;

    public function __construct(
        KickerProvider $kickerProvider,
        PlayerRepository $playerRepository,
        ScoreRepository $scoreRepository,
        ChartBuilderInterface $chartBuilder
    )
    {
        $this->kickerProvider = $kickerProvider;

        $this->playerRepository = $playerRepository;

        $this->scoreRepository = $scoreRepository;

        $this->chartBuilder = $chartBuilder;
    }

    /**
     * @throws Exception|TransportExceptionInterface
     */
    #[Route('/game/dashboard', name: 'app_game_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('game/dashboard.html.twig', [
            'news' => $this->kickerProvider->getNewsAsArray(),
            'scores' => $this->getScoresForTable(),
            'chart' => $this->createChart(),
        ]);
    }

    #[Route('/game/team', name: 'app_game_team')]
    public function team(): Response
    {
        $user = $this->getUser();

        $players = $this->playerRepository->findByUser($user);

        $moneySpend = 0;
        $budget = 60000000;
        $playersNeeded = 22;

        foreach ($players as $player) {
            $moneySpend += $player->getSigningFee();
        }

        $moneyLeft = $budget - $moneySpend;
        $playersLeft = $playersNeeded - count($players);
        $moneyPerPlayerLeft = ($playersLeft <= 0) ? 0 : $moneyLeft / $playersLeft;

        return $this->render('game/team.html.twig', [
            'players' => $players,
            'playersNeeded' => $playersNeeded,
            'budget' => $budget,
            'moneySpend' => $moneySpend,
            'moneyLeft' => $moneyLeft,
            'moneyPerPlayerLeft' => $moneyPerPlayerLeft,
        ]);
    }

    #[Route('/game/lineup', name: 'app_game_lineup')]
    public function lineup(): Response
    {
        return $this->render('game/lineup.html.twig');
    }

    #[Route('/game/standings', name: 'app_game_standings')]
    public function standings(): Response
    {
        return $this->render('game/standings.html.twig');
    }

    private function getScoresForTable(): array
    {
        $result = [];
        $userResults = [];
        $scores = $this->scoreRepository->findAll();

        foreach ($scores as $score) {
            if (! $score->getUser()) {
                continue;
            }

            if (! isset($userResults[$score->getUser()->getName()])) {
                $userResults[$score->getUser()->getName()] = [
                    'name' => $score->getUser()->getName(),
                    'score' => 0,
                ];
            }

            $userResults[$score->getUser()->getName()]['score'] += $score->getScore();
        }

        foreach ($userResults as $userResult) {
            $result[] = $userResult;
        }

        usort($result, static function ($a, $b) {
            return $a["score"] <=> $b["score"];
        });

        return array_reverse($result);
    }

    private function createChart(): Chart
    {
        $user = $this->getUser();

        $scores = $this->scoreRepository->findByUser($user);

        $chart = $this->chartBuilder->createChart(Chart::TYPE_BAR);

        $matchDays = range(1, 34);
        $labels = [];
        $data = [];

        foreach ($matchDays as $matchDay) {
            $labels[] = $matchDay;
            $data[] = 0;
        }

        foreach ($scores as $score) {
            $data[$score->getMatchDay() - 1] = $score->getScore();
        }

        $simplesScores = array_map(static function ($score) {
            return $score->getScore();
        }, $scores);

        $min = count($simplesScores) > 0 ? min($simplesScores) : 0;
        $max = count($simplesScores) > 0 ? max($simplesScores) : 100;

        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Punkte pro Spieltag',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data,
                ],
            ],
        ]);

        $chart->setOptions([
            'responsive' => true,
            'scales' => [
                'y' => [
                    'suggestedMin' => $min,
                    'suggestedMax' => $max,
                ],
            ],
        ]);

        return $chart;
    }
}

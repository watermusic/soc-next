<?php

namespace App\Provider;

use App\Entity\Team;
use App\Repository\PositionRepository;
use App\Repository\TeamRepository;
use DateTime;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use RuntimeException;
use Symfony\Component\DomCrawler\Crawler;

class KickerProvider
{
    public const IMAGE_TEAM_DEFAULT_PATH = '/images/teams/unknown.png';

    private PositionRepository $positionRepository;

    private TeamRepository $teamRepository;

    public function __construct(
        PositionRepository $positionRepository,
        TeamRepository $teamRepository
    ) {
        $this->positionRepository = $positionRepository;

        $this->teamRepository = $teamRepository;
    }

    /**
     * @throws Exception
     */
    #[ArrayShape(['news' => 'array'])]
    public function getNewsAsArray(): array
    {
        $feedUrl = 'https://newsfeed.kicker.de/news/bundesliga';

        $teams = $this->teamRepository->findAll();

        $crawler = new Crawler(file_get_contents($feedUrl));

        $result = [];
        foreach ($crawler->filterXPath('//rss/channel/item') as $item) {
            $element = new Crawler($item);

            $description = $element->filterXPath('//description')->text();

            $result[] = [
                'title' => $element->filterXPath('//title')->text(),
                'image' => $this->guessTeamImageByDescription($teams, $description),
                'link' => $element->filterXPath('//link')->text(),
                'description' => $description,
                'createdAt' => new DateTime($element->filterXPath('//pubDate')->text()),
            ];
        }

        return $result;
    }

    /**
     * @param Team[] $teams
     */
    private function guessTeamImageByDescription(array $teams, string $description): string
    {
        $imagePath = null;

        foreach ($teams as $team) {
            if (str_contains(mb_strtolower($description), mb_strtolower($team->getName()))) {
                $imagePath = $team->getPublicThumbUrl();

                break;
            }
        }

        return $imagePath ?? self::IMAGE_TEAM_DEFAULT_PATH;
    }

    public function getPlayersByTeam(string $teamName): array
    {
        $teams = $this->getTeams();

        $teamNames = array_column($teams, 'name');
        if (!in_array($teamName, $teamNames, true)) {
            throw new RuntimeException("[$teamName] is an invalid name. Valid provide values are [" . implode(",", $teamNames) . "]");
        }

        $playerResult = [];
        $teamUrl = str_replace('info', 'kader', $teams[$teamName]['url']);

        $crawler = new Crawler(file_get_contents($teamUrl));

        $positions = $crawler->filter('[data-target=squadContent] div > div');

        foreach ($positions as $position) {
            $positionNode = new Crawler($position);

            $positionName = $positionNode->filter('h2')->extract(['_text'])[0];

            $players = $positionNode->filter('.kick__table--ranking__index.kick__t__a__l');

            foreach ($players as $player) {
                $playerNode = new Crawler($player);

                $vorname = $playerNode->filter('a > span')->extract(['_text']);

                if(empty($vorname)) {
                    continue;
                }

                $vorname = $vorname[0];
                $nachname = $playerNode->filter('a > strong')->extract(['_text'])[0];
                $externalDetailsUrl = $playerNode->filter('a')->extract(['href'])[0];
                $slug = explode("/", $externalDetailsUrl);

                $result = [
                    'slug' => $slug[1],
                    'name' => $nachname,
                    'externalDetailsUrl' => 'https://www.kicker.de' . $externalDetailsUrl,
                    'team' => $teamName,
                    'averageGrade' => 3.5,
                    'marketValue' => 0.0,
                    'averageScore' => 0.0,
                    'externalThumbUrl' => '', //$playerNode->filter('img')->extract(['src'])[0],
                    'position' => $positionName,
                ];

                $playerResult[] = $result;
            }
        }

        return $playerResult;
    }

    public function getTeams(): array
    {
        $tableUrl = 'https://www.kicker.de/bundesliga/tabelle/2022-23/1';

        $teamsResult = [];

        $crawler = new Crawler(file_get_contents($tableUrl));

        $teams = $crawler->filter('.kick__v100-gameCell__team');

        foreach ($teams as $team) {
            $teamNode = new Crawler($team);

            $result = [
                'name' => trim($teamNode->filter('.kick__v100-gameCell__team__name')->extract(['_text'])[0]),
                'url' => 'https://www.kicker.de' . $teamNode->extract(['href'])[0],
                'logo' => str_replace('https://derivates.kicker.de/image/fetch/w_30,h_30,c_fit,q_auto:best/', '', $teamNode->filter('.kick__v100-gameCell__team__logo img')->extract(['data-src'])[0]),
            ];

            $teamsResult[$result['name']] = $result;
        }

        return $teamsResult;
    }
}

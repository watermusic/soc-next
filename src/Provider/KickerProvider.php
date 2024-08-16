<?php /** @noinspection ALL */

namespace App\Provider;

use App\Entity\Team;
use App\Repository\PositionRepository;
use App\Repository\TeamRepository;
use DateTime;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use JsonException;
use RuntimeException;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class KickerProvider
{
    public const IMAGE_TEAM_DEFAULT_PATH = '/images/teams/unknown.png';

    private PositionRepository $positionRepository;

    private TeamRepository $teamRepository;

    private HttpClientInterface $httpClient;

    private static string $databaseUrl = 'https://www.kicker-libero.de/api/sportsdata/v1/client_database/se-k00012024/717730ef757c139876ad50a12af9b831.json';

    private static array|null $data = null;

    public function __construct(
        PositionRepository $positionRepository,
        TeamRepository $teamRepository,
        HttpClientInterface $httpClient
    ) {
        $this->positionRepository = $positionRepository;

        $this->teamRepository = $teamRepository;

        $this->httpClient = $httpClient;
    }

    /**
     * @throws Exception
     * @throws TransportExceptionInterface
     */
    #[ArrayShape(['news' => 'array'])]
    public function getNewsAsArray(): array
    {
        $feedUrl = 'https://newsfeed.kicker.de/news/bundesliga';

        $teams = $this->teamRepository->findAll();

        $response = $this->httpClient->request('GET', $feedUrl);

        $crawler = new Crawler($response->getContent());

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

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getPlayersByTeam(string $teamName): array
    {
        $teams = $this->getTeams();

        $teamNames = array_column($teams, 'name');
        if (!in_array($teamName, $teamNames, true)) {
            throw new RuntimeException("[$teamName] is an invalid name. Valid provide values are [" . implode(",", $teamNames) . "]");
        }

        /** @var Team $team */
        $team = array_values(array_filter($this->teamRepository->findAll(), fn (Team $team) => $team->getName() === $teamName))[0];

        $slugger = new AsciiSlugger();

        $players = $this->getData()['players'];

        foreach ($players as $player) {

            if ($player['teamId'] !== $team->getExternalId()) {
                continue;
            }

            $vorname = $player['firstName'];
            $nachname = $player['displayName'];
            $externalDetailsUrl = $player['photo'];
            $slug = $slugger->slug(mb_strtolower($vorname . '-' . $nachname));

            $averageGrade = $player['ratingBreakDown']['averageGrade'] ?? 100;

            $averageGrade /= 100;

            $photo = ($player['photo'] === null) ? $player['photoFallback'] : $player['photo'];

            if ($photo === null) {
                $photo = '';
            }

            $result = [
                'slug' => $slug,
                'name' => $nachname,
                'externalDetailsUrl' => 'https://www.kicker.de/' . $slug . '/spieler',
                'team' => $teamName,
                'averageGrade' => $averageGrade,
                'marketValue' => $player['marketValue'],
                'averageScore' => $player['rating'],
                'externalThumbUrl' => $photo,
                'position' => $this->getPositionenNameByExternalName($player['position']),
            ];

            $playerResult[] = $result;
        }

        return $playerResult;
    }

    /**
     * @return array
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getTeams(): array
    {
        $tableUrl = 'https://www.kicker.de/bundesliga/tabelle/2024-25/1';

        $teamsResult = [];

        $response = $this->httpClient->request('GET', $tableUrl);

        $crawler = new Crawler($response->getContent());

        $teams = $crawler->filter('.kick__v100-gameCell__team');

        foreach ($teams as $team) {
            $teamNode = new Crawler($team);

            $name = trim($teamNode->filter('.kick__v100-gameCell__team__name')->extract(['_text'])[0]);
            $result = [
                'name' => $name,
                'url' => 'https://www.kicker.de' . $teamNode->extract(['href'])[0],
                'logo' => str_replace('https://derivates.kicker.de/image/fetch/w_30%2Ch_30%2Cc_fit%2Cq_auto:best/', '', $teamNode->filter('.kick__v100-gameCell__team__logo img')->extract(['src'])[0]),
                'externalId' => $this->getExternalTeamIdByName($name),
            ];

            $teamsResult[$result['name']] = $result;
        }

        return $teamsResult;
    }

    private function getExternalTeamIdByName(string $name): string
    {
        $externalId = null;

        $teams = $this->getData()['teams'];

        foreach ($teams as $team) {
            if ($team['shortName'] === $name) {
                $externalId = $team['id'];
            }
        }

        if ($externalId === null) {
            throw new RuntimeException('Team with name ' . $name . ' not found in Kicker.de database.');
        }

        return $externalId;
    }

    private function getPositionenNameByExternalName(string $externalName): string
    {
        $positions = $this->positionRepository->findAll();

        $result = null;

        foreach ($positions as $position) {
            if ($externalName === $position->getInfoUri()) {
                $result = $position->getName();
            }
        }

        if ($result === null) {
            throw new RuntimeException('Position with external name ' . $externalName . ' not found in Kicker.de database.');
        }

        return $result;
    }

    /**
     * @throws JsonException
     */
    public static function getData(): array
    {
        if (self::$data === null) {
            self::$data = json_decode(file_get_contents(self::$databaseUrl), true, 512, JSON_THROW_ON_ERROR);
        }

        return self::$data;
    }
}

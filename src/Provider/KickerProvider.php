<?php

namespace App\Provider;

use App\Repository\PositionRepository;
use DateTime;
use Exception;
use JetBrains\PhpStorm\ArrayShape;
use RuntimeException;
use Symfony\Component\DomCrawler\Crawler;

class KickerProvider
{
    private PositionRepository $positionRepository;

    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    /**
     * @throws Exception
     */
    #[ArrayShape(['news' => 'array'])]
    public function getNewsAsArray(): array
    {
        $feedUrl = 'https://newsfeed.kicker.de/news/bundesliga';

        $crawler = new Crawler(file_get_contents($feedUrl));

        $result = [];
        foreach ($crawler->filterXPath('//rss/channel/item') as $item) {
            $element = new Crawler($item);

            $result[] = [
                'title' => $element->filterXPath('//title')->text(),
                'image' => '',
                'link' => $element->filterXPath('//link')->text(),
                'description' => $element->filterXPath('//description')->text(),
                'createdAt' => new DateTime($element->filterXPath('//pubDate')->text()),
            ];
        }

        return $result;
    }

    public function getPlayersByPosition(string $position): array
    {
        $decorator = <<<'HTML'
<!DOCTYPE html>
<html lang="de">
    <body>
        <div class="list">%s</div>
    </body>
</html>
HTML;

        $playerResult = [];

        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $position = $this->positionRepository->findOneBy(['name' => $position], []);

        if (null === $position) {
            throw new RuntimeException("Could not find position by name with [name => $position]");
        }

        /** @var string $uri */
        $body = file_get_contents($position->getInfoUri());
        $html = sprintf($decorator, $body);

        $crawler = new Crawler($html);

        $players = $crawler->filter('div.pli');

        foreach ($players as $player) {
            $playerNode = new Crawler($player);

            $result = [
                'externalId' => str_replace('pli_', '', $playerNode->extract(['id'])[0]),
                'name' => $playerNode->filter('a')->extract(['_text'])[0],
                'externalDetailsUrl' => $playerNode->filter('a')->extract(['href'])[0],
                'team' => $playerNode->filter('span.vrn')->extract(['_text'])[0],
                'averageGrade' => 3.5,
                'marketValue' => (float) str_replace(',', '.', $playerNode->filter('span.wert b')->extract(['_text'])[0]) * 100000000,
                'averageScore' => (float) $playerNode->filter('span.pkt b')->extract(['_text'])[0],
                'externalThumbUrl' => $playerNode->filter('img')->extract(['src'])[0],
                'position' => $position,
            ];

//            $result["team"] = str_replace(
//                ["VfB", "HSV", "E. Frankfurt"],
//                ["Stuttgart", "Hamburg", "Frankfurt"],
//                $result["team"]
//            );

            $playerResult[] = $result;
        }

        return $playerResult;
    }
}

<?php

namespace App\Command;

use App\Entity\Team;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
use Knp\Bundle\GaufretteBundle\FilesystemMap;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'soc:retrieve:assets',
    description: 'Retrieves player and team assets from kicker.de website.',
)]
class RetrieveAssetsCommand extends Command
{
    private TeamRepository $teamRepository;

    private PlayerRepository $playerRepository;

    private FilesystemMap $filesystemMap;

    private HttpClientInterface $httpClient;

    public function __construct(
        TeamRepository $teamRepository,
        PlayerRepository $playerRepository,
        FilesystemMap $filesystemMap,
        HttpClientInterface $httpClient
    ) {
        $this->teamRepository = $teamRepository;

        $this->playerRepository = $playerRepository;

        $this->filesystemMap = $filesystemMap;

        $this->httpClient = $httpClient;

        parent::__construct('soc:retrieve:assets');
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->success('Start downloading player & team assets...');

        $this->storeTeamAssets($io);

        $this->storePlayerAssets($io);

        $io->success('...done.');

        return Command::SUCCESS;
    }

    /**
     * @param SymfonyStyle $io
     */
    private function storePlayerAssets(SymfonyStyle $io): void
    {
        $players = $this->playerRepository->findAll();

        $progressBar = $io->createProgressBar(count($players));
        $progressBar->setMessage('Store player assets');

        foreach ($players as $player) {
            if ($this->filesystemMap->get('public_images')->has($player->getStorageKey())) {
                $progressBar->advance();

                continue;
            }

            $imgUrl = $player->getExternalThumbUrl();

            if ($imgUrl === '') {
                continue;
            }

            $this->filesystemMap->get('public_images')->write($player->getStorageKey(), file_get_contents($imgUrl), true);

            $progressBar->advance();

        }
        $progressBar->finish();
        $io->writeln('.');
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ClientExceptionInterface
     */
    private function storeTeamAssets(SymfonyStyle $io): void
    {
        $urlKickerTeams = 'https://www.kicker.de/bundesliga/vereine';

        $response = $this->httpClient->request('GET', $urlKickerTeams);

        $crawler = new Crawler($response->getContent());

        $images = $crawler->filter('.kick__table .kick__table--ranking__teamicon :not(.kick__table--ranking__img-wrapper) img');

        $progressBar = $io->createProgressBar(count($images));
        $progressBar->setMessage('Store team assets');

        foreach ($images as $image) {
            $team = $this->guessTeamName($image->attributes->getNamedItem('alt')->textContent);
            $imageUrl = str_replace('https://derivates.kicker.de/image/fetch/w_30,h_30,c_fit,q_auto:best/', '', $image->attributes->getNamedItem('src')->textContent);

            if ($this->filesystemMap->get('public_images')->has($team->getStorageKey())) {
                $progressBar->advance();

                continue;
            }

            $this->filesystemMap->get('public_images')->write($team->getStorageKey(), file_get_contents($imageUrl), true);

            $progressBar->advance();
        }

        $progressBar->finish();

        $io->writeln('');
    }

    private function guessTeamName($name): Team
    {
        $teams = null;

        if (null === $teams) {
            $teams = $this->teamRepository->findAll();
        }

        foreach ($teams as $team) {
            if (str_contains(mb_strtolower($name), mb_strtolower($team->getName()))) {
                return $team;
            }
        }

        $team = new Team();
        $team->setName($name);

        return $team;
    }
}

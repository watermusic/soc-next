<?php /** @noinspection DisconnectedForeachInstructionInspection */

namespace App\Command;

use App\Entity\Player;
use App\Entity\Position;
use App\Entity\Team;
use App\Provider\KickerProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'soc:player:import',
    description: 'Imports Player from the Kicker.de Website in Storage',
)]
class PlayerImportCommand extends Command
{
    protected ManagerRegistry $doctrine;

    protected KickerProvider $kickerProvider;

    public function __construct(ManagerRegistry $doctrine, KickerProvider $kickerProvider)
    {
        $this->doctrine = $doctrine;

        $this->kickerProvider = $kickerProvider;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('soc:player:import')
            ->addOption('erase-data', null, InputOption::VALUE_OPTIONAL, 'Should the database data be erased?', false)
            ->setDescription('Imports Player from the Kicker.de Website in Storage')
            ->setHelp(
                <<<EOT
                The <info>soc:player:import</info> Imports Player from the Kicker.de Website in Storage
    <info>./app/console soc:player:import</info>
    Options:
    - clear
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $eraseData = $input->getOption('erase-data');

        if (true === $eraseData) {
            $connection = $this->doctrine->getConnection();

            $connection->executeQuery('SET foreign_key_checks = 0');
            $connection->executeQuery('TRUNCATE soc_player');
            $connection->executeQuery('TRUNCATE soc_team');
            $connection->executeQuery('SET foreign_key_checks = 1');
        }

        $this->updateTeams($io);
        $this->updatePlayers($io);

        $io->success('Done.');

        return Command::SUCCESS;
    }

    private function updatePlayers(SymfonyStyle $io): void
    {
        $om = $this->doctrine->getManager();

        $positionRepo = $om->getRepository(Position::class);
        $positions = $positionRepo->findAll();

        $teamRepo = $om->getRepository(Team::class);
        $teams = $teamRepo->findAll();

        $playerRepo = $om->getRepository(Player::class);

        $playersCollection = new ArrayCollection($playerRepo->findAll());

        $playersUpdated = 0;
        $playersCreated = 0;

        $teamsKicker = $this->kickerProvider->getTeams();

        $io->writeln('Update players');

        foreach ($teamsKicker as $team) {
            $players = $this->kickerProvider->getPlayersByTeam($team['name']);

            $io->writeln($team['name']);

            $progressBar = $io->createProgressBar(count($players));

            foreach ($players as $player) {

                $progressBar->advance();

                if ($playersCollection->exists(function ($key, $element) use ($player) {
                    return $element->getName() === $player['name'];
                })) {
                    ++$playersUpdated;

                    continue;
                }

                $entity = new Player();
                $entity
                    ->setName($player['name'])
                    ->setTeam($this->findTeamByName($teams, $team['name']))
                    ->setAverageGrade($player['averageGrade'])
                    ->setSigningFee(0.0)
                    ->setMarketValue($player['marketValue'])
                    ->setPosition($this->findPositionByName($positions, $player['position']))
                    ->setExternalDetailsUrl($player['externalDetailsUrl'])
                    ->setExternalThumbUrl($player['externalThumbUrl'])
                    ->setExternalId(1)
                    ->setExternalSlug($player['slug'])
                    ->setThumbUrl($player['slug'].'.png')
                    ->setAverageScore($player['averageScore']);

                $om->persist($entity);
                ++$playersCreated;
            }
            $progressBar->finish();
            $io->writeln("");
        }

        $om->flush();

        $io->success("#$playersCreated Players have been created");
        $io->success("#$playersUpdated Players have been updated");
    }

    /**
     * @param Team[] $teams
     * @param string $name
     * @return Team|null
     */
    private function findTeamByName(array $teams, string $name): ?Team
    {
        foreach ($teams as $team) {
            if ($team->getName() === $name) {
                return $team;
            }
        }

        return null;
    }

    /**
     * @param Position[] $positionen
     * @param string $name
     * @return Position|null
     */
    private function findPositionByName(array $positionen, string $name): ?Position
    {
        foreach ($positionen as $position) {
            if ($position->getName() === $name) {
                return $position;
            }
        }

        return null;
    }



    private function updateTeams(SymfonyStyle $io): void
    {
        $om = $this->doctrine->getManager();

        $teamRepo = $om->getRepository(Team::class);
        $teamsCollection = new ArrayCollection($teamRepo->findAll());

        $teams = $this->kickerProvider->getTeams();

        asort($teams);

        $io->writeln('Update teams');

        $progressBar = $io->createProgressBar(count($teams));

        foreach ($teams as $team) {
            $progressBar->advance();

            if ($teamsCollection->exists(function ($key, $element) use ($team) {
                return $element->getName() === $team['name'];
            })) {
                continue;
            }

            $entity = new Team();
            $entity->setName($team['name']);
            $om->persist($entity);
        }
        $progressBar->finish();
        $om->flush();

        $io->success('Teams have been updated');
    }
}

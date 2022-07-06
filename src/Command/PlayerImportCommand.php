<?php

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
            )
            ;
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

        $teamRepo = $om->getRepository(Team::class);
        $teams = $teamRepo->findAll();

        $positionRepo = $om->getRepository(Position::class);
        $positions = $positionRepo->findAll();

        $playerRepo = $om->getRepository(Player::class);

        $playersCollection = new ArrayCollection($playerRepo->findAll());

        $playersUpdated = 0;
        $playersCreated = 0;

        foreach ($positions as $position) {
            $players = $this->kickerProvider->getPlayersByPosition($position);

            foreach ($players as $player) {
                $t = null;
                foreach ($teams as $team) {
                    /** @var Team $team */
                    if ($team->getName() === $player['team']) {
                        $t = $team;
                    }
                }

                $player['externalId'] = (int) $player['externalId'];

                if ($playersCollection->exists(function ($key, $element) use ($player) {
                    return $element->getExternalId() === $player['externalId'];
                })) {
                    ++$playersUpdated;

                    continue;
                }

                $entity = new Player();
                $entity
                    ->setName($player['name'])
                    ->setTeam($t)
                    ->setAverageGrade($player['averageGrade'])
                    ->setSigningFee(0.0)
                    ->setMarketValue($player['marketValue'])
                    ->setPosition($position)
                    ->setExternalDetailsUrl('https://manager.kicker.de'.$player['externalDetailsUrl'])
                    ->setExternalThumbUrl($player['externalThumbUrl'])
                    ->setExternalId($player['externalId'])
                    ->setThumbUrl($player['externalId'].'.png')
                    ->setAverageScore($player['averageScore']);

                $om->persist($entity);

                ++$playersCreated;
            }
            $om->flush();
        }

        $io->success("#$playersCreated Players have been created");
        $io->success("#$playersUpdated Players have been updated");
    }

    private function updateTeams(SymfonyStyle $io): void
    {
        $om = $this->doctrine->getManager();

        $positionRepo = $om->getRepository(Position::class);
        $positions = $positionRepo->findAll();

        $players = $this->kickerProvider->getPlayersByPosition($positions[0]->getName());

        $vereine = [];
        foreach ($players as $player) {
            if (!in_array($player['team'], $vereine, true)) {
                $vereine[] = $player['team'];
            }
        }

        asort($vereine);

        foreach ($vereine as $verein) {
            $team = new Team();
            $team->setName($verein);
            $om->persist($team);
        }
        $om->flush();

        $io->success('Teams have been updated');
    }
}

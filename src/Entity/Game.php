<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ORM\Table(name: 'soc_game')]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime_immutable')]
    private ?\DateTimeImmutable $kickOffAt;

    #[ORM\Column(type: 'integer')]
    private ?int $matchDay;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'guestGames')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $guestTeam;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'homeGames')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $homeTeam;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKickOffAt(): ?\DateTimeImmutable
    {
        return $this->kickOffAt;
    }

    public function setKickOffAt(\DateTimeImmutable $kickOffAt): self
    {
        $this->kickOffAt = $kickOffAt;

        return $this;
    }

    public function getMatchDay(): ?int
    {
        return $this->matchDay;
    }

    public function setMatchDay(int $matchDay): self
    {
        $this->matchDay = $matchDay;

        return $this;
    }

    public function getGuestTeam(): ?Team
    {
        return $this->guestTeam;
    }

    public function setGuestTeam(?Team $guestTeam): self
    {
        $this->guestTeam = $guestTeam;

        return $this;
    }

    public function getHomeTeam(): ?Team
    {
        return $this->homeTeam;
    }

    public function setHomeTeam(?Team $homeTeam): self
    {
        $this->homeTeam = $homeTeam;

        return $this;
    }
}

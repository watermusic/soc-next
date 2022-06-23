<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $fee;

    #[ORM\Column(type: 'integer')]
    private ?int $marketValue;

    #[ORM\Column(type: 'float')]
    private ?float $averageGrade;

    #[ORM\Column(type: 'float')]
    private ?float $averageScore;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $thumbUrl;

    #[ORM\ManyToOne(targetEntity: Position::class, inversedBy: 'players')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Position $position;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'players')]
    private ?User $user;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'players')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $team;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFee(): ?int
    {
        return $this->fee;
    }

    public function setFee(?int $fee): self
    {
        $this->fee = $fee;

        return $this;
    }

    public function getMarketValue(): ?int
    {
        return $this->marketValue;
    }

    public function setMarketValue(int $marketValue): self
    {
        $this->marketValue = $marketValue;

        return $this;
    }

    public function getAverageGrade(): ?float
    {
        return $this->averageGrade;
    }

    public function setAverageGrade(float $averageGrade): self
    {
        $this->averageGrade = $averageGrade;

        return $this;
    }

    public function getAverageScore(): ?float
    {
        return $this->averageScore;
    }

    public function setAverageScore(float $averageScore): self
    {
        $this->averageScore = $averageScore;

        return $this;
    }

    public function getThumbUrl(): ?string
    {
        return $this->thumbUrl;
    }

    public function setThumbUrl(?string $thumbUrl): self
    {
        $this->thumbUrl = $thumbUrl;

        return $this;
    }

    public function getPosition(): ?Position
    {
        return $this->position;
    }

    public function setPosition(?Position $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getTeam(): ?Team
    {
        return $this->team;
    }

    public function setTeam(?Team $team): self
    {
        $this->team = $team;

        return $this;
    }
}

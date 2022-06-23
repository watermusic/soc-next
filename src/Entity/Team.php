<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $name;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Player::class)]
    private ArrayCollection $players;

    #[ORM\OneToMany(mappedBy: 'guestTeam', targetEntity: Game::class)]
    private ArrayCollection $guestGames;

    #[ORM\OneToMany(mappedBy: 'homeTeam', targetEntity: Game::class)]
    private ArrayCollection $homeGames;

    public function __construct()
    {
        $this->players = new ArrayCollection();
        $this->guestGames = new ArrayCollection();
        $this->homeGames = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Player>
     */
    public function getPlayers(): Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player): self
    {
        if (!$this->players->contains($player)) {
            $this->players[] = $player;
            $player->setTeam($this);
        }

        return $this;
    }

    public function removePlayer(Player $player): self
    {
        if ($this->players->removeElement($player)) {
            // set the owning side to null (unless already changed)
            if ($player->getTeam() === $this) {
                $player->setTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGuestGames(): Collection
    {
        return $this->guestGames;
    }

    public function addGuestGame(Game $guestGame): self
    {
        if (!$this->guestGames->contains($guestGame)) {
            $this->guestGames[] = $guestGame;
            $guestGame->setGuestTeam($this);
        }

        return $this;
    }

    public function removeGuestGame(Game $guestGame): self
    {
        if ($this->guestGames->removeElement($guestGame)) {
            // set the owning side to null (unless already changed)
            if ($guestGame->getGuestTeam() === $this) {
                $guestGame->setGuestTeam(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getHomeGames(): Collection
    {
        return $this->homeGames;
    }

    public function addHomeGame(Game $homeGame): self
    {
        if (!$this->homeGames->contains($homeGame)) {
            $this->homeGames[] = $homeGame;
            $homeGame->setHomeTeam($this);
        }

        return $this;
    }

    public function removeHomeGame(Game $homeGame): self
    {
        if ($this->homeGames->removeElement($homeGame)) {
            // set the owning side to null (unless already changed)
            if ($homeGame->getHomeTeam() === $this) {
                $homeGame->setHomeTeam(null);
            }
        }

        return $this;
    }
}

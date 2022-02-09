<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\RandomMatch;
use App\Controller\StartMatch;

/**
 * Class Player
 * @package App\Entity
 *
    @ApiResource(
        normalizationContext={"groups"={"read:player", "write:player"}},
        collectionOperations={"get", "post",
            "get_random_match"={
                "path"="/players/RandomMatch",
                "method"="GET",
                "controller"=App\Controller\RandomMatch::class
            },
        },
        itemOperations={"get", "put", "delete"}
    )
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 * @ORM\Table(name="player")
 */
class Player
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read:player"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length= 50)
     * @Groups({"read:player", "write:player"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length= 255, nullable= true)
     * @Groups({"read:player", "write:player"})
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:player", "write:player"})
     */
    private $strength;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:player", "write:player"})
     */
    private $physicalCondition;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:player", "write:player"})
     */
    private $defense;

    /**
     * @ORM\ManyToOne(targetEntity="Team", inversedBy="players", cascade={"persist"})
     * @Groups({"read:player", "write:player"})
     */
    private $team;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getPhysicalCondition(): ?int
    {
        return $this->physicalCondition;
    }

    public function setPhysicalCondition(int $physicalCondition): self
    {
        $this->physicalCondition = $physicalCondition;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;

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

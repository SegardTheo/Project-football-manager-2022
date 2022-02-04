<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StatsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatsRepository::class)]
#[ApiResource]
class Stats
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $strength;

    #[ORM\Column(type: 'integer')]
    private $physicalCondition;

    #[ORM\Column(type: 'integer')]
    private $defense;

    public function getId(): ?int
    {
        return $this->id;
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
}

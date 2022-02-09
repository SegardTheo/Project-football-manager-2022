<?php


namespace App\Service;


use App\Entity\Player;

class MatchService
{
    public $firstTeam;
    public $secondTeam;

    private $attackFirstTeam;
    private $defenseFirstTeam;

    private $defenseSecondTeam;
    private $attackSecondTeam;

    private $scoreFirstTeam;
    private $scoreSecondTeam;

    /**
     * @return int
     */
    public function getScoreFirstTeam(): int
    {
        return $this->scoreFirstTeam;
    }

    /**
     * @param int $scoreFirstTeam
     */
    public function setScoreFirstTeam(int $scoreFirstTeam): void
    {
        $this->scoreFirstTeam = $scoreFirstTeam;
    }

    /**
     * @return int
     */
    public function getScoreSecondTeam(): int
    {
        return $this->scoreSecondTeam;
    }

    /**
     * @param int $scoreSecondTeam
     */
    public function setScoreSecondTeam(int $scoreSecondTeam): void
    {
        $this->scoreSecondTeam = $scoreSecondTeam;
    }

    public function __construct($firstTeam, $secondTeam)
    {
        $this->firstTeam = $firstTeam;
        $this->secondTeam = $secondTeam;

        $this->scoreFirstTeam = 0;
        $this->scoreSecondTeam = 0;
    }

    public function calculScore()
    {
        $this->calculStatsTeams();

        $matchTimer = 90;
        $timerSplit = 15;

        while($matchTimer > 0)
        {
            if($this->propabilityGoal($this->attackFirstTeam))
            {
                $this->scoreFirstTeam += 1;
            }

            if($this->propabilityGoal($this->attackSecondTeam))
            {
                $this->scoreSecondTeam += 1;
            }

            $matchTimer = $matchTimer - $timerSplit;
        }
    }

    private function propabilityGoal($proba)
    {
        $rand = rand(1, 100);

        // if <= proba, It's a goal !
        return $rand <= $proba;
    }

    private function calculStatsTeams()
    {
        /** @var Player $player */

        // Stats 1st team
        foreach ($this->firstTeam as $player)
        {
            $this->attackFirstTeam += $player->getStrength();
            $this->defenseFirstTeam += $player->getDefense();
        }

        $this->attackFirstTeam = $this->attackFirstTeam / count($this->firstTeam);
        $this->defenseFirstTeam = $this->defenseFirstTeam / count($this->firstTeam);

        // Stats 2nd team
        foreach ($this->secondTeam as $player)
        {
            $this->attackSecondTeam += $player->getStrength();
            $this->defenseSecondTeam += $player->getDefense();
        }

        $this->attackSecondTeam = $this->attackSecondTeam / count($this->secondTeam);
        $this->defenseSecondTeam = $this->defenseSecondTeam / count($this->secondTeam);

        $this->attackFirstTeam = $this->attackFirstTeam - $this->defenseSecondTeam;
        $this->attackSecondTeam = $this->attackSecondTeam - $this->defenseFirstTeam;
    }
}

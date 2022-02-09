<?php

namespace App\DataFixtures;

use App\Entity\Player;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 20; $i++) {
            $player = new Player();
            $player->setName('Joueur_ '.$i);
            $player->setDescription("Une description.");
            $player->setStrength(95);
            $player->setDefense(62);
            $player->setPhysicalCondition(100);
            $manager->persist($player);
        }

        $manager->flush();
    }
}

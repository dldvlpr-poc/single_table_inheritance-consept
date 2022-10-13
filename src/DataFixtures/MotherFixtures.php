<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Mother;

class MotherFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $mother = new Mother();
        $mother->setName('titi');
        $manager->persist($mother);
        $manager->flush();
    }
}
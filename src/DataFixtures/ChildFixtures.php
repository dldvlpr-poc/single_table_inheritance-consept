<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Child;

class ChildFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $child = new Child();
        $child->setName('toto');
        $child->setDescription('je suis une description.');
        $manager->persist($child);
        $manager->flush();
    }
}
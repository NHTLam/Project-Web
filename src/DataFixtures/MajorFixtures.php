<?php

namespace App\DataFixtures;

use App\Entity\Major;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MajorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=3; $i++){
            $major = new Major;
            $major->setName("Major $i");
            $major->setCourse(rand(5,10));            
            $manager->persist($major);
        }

        $manager->flush();

    }
}

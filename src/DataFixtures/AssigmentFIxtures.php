<?php

namespace App\DataFixtures;

use App\Entity\Assignment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class Assigment extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=3; $i++){
            $assignment = new Assignment;
            $assignment->setTitle("Assigment $i");
            $assignment->setDateSubmit(\DateTime::createFromFormat('Y/m/d', '2022/06/21'));
            $assignment->setFile("File here");
            $manager->persist($assignment);
        }

        $manager->flush();
    }
}

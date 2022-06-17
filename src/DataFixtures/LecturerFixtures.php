<?php

namespace App\DataFixtures;

use App\Entity\Lectures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LecturerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i<8; $i++){
            $lec = new Lectures;
            $lec -> setName("Lecture $i");
            $manager -> persist($lec);
        }

        $manager->flush();
    }
}

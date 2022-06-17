<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i<10; $i++){
            $std = new Student;
            $std -> setName("Student $i");
            $std -> setImage("https://cdn-icons-png.flaticon.com/512/67/67902.png");
            $manager -> persist($std);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Classes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClassFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i =0; $i<10; $i++){
            $class = new Classes;
            $class -> setName("Class $i");
            $class -> setStdQuantity(rand(20,25));
            $manager->persist($class);
        }

        $manager->flush();
    }
}

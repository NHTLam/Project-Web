<?php

namespace App\DataFixtures;

use App\Entity\Assignment;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AssignmentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=10; $i++){
            $assignment = new Assignment;
            $assignment->setTitle("Assigment $i");
            $assignment->setDeadline(\DateTime::createFromFormat('Y/m/d', '2022/07/01'));
            $assignment->setQuestion("1 + 1 = ?");
            $manager->persist($assignment);
        }

        $manager->flush();
    }
}

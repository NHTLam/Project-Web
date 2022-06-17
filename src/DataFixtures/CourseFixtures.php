<?php

namespace App\DataFixtures;

use App\Entity\Courses;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CourseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0;$i<5;$i++){
            $course = new Courses;
            $course -> setName("Course $i");
            $course -> setStartDate(\DateTime::createFromFormat('Y-m-d', '2022-6-16'));
            $course -> setEndDate(\DateTime::createFromFormat('Y-m-d', '2022-8-16'));
            $manager -> persist($course);
        }

        $manager->flush();
    }
}

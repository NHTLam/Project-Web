<?php

namespace App\DataFixtures;

use App\Entity\Student;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StudentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++){
            $student = new Student;
            $student->setName("Student $i");
            $student->setGender("Male");
            $student->setBirthdate(\DateTime::createFromFormat('Y/m/d', '2002/02/16'));
            $student->setAddress("Ha Noi");
            $student->setEmail("student@fpt.edn.vn");
            $manager->persist($student);
        }

        $manager->flush();
    }
}

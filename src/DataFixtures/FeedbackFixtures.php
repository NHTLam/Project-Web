<?php

namespace App\DataFixtures;

use App\Entity\Feedback;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FeedbackFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=10; $i++){
            $feedback = new Feedback;
            $feedback->setGrade((float)(rand(0,10)));
            $feedback->setComment("Comment for assigment $i");
            $feedback->setDateFeedback(\DateTime::createFromFormat('Y/m/d', '2022/07/01'));
            $manager->persist($feedback);            
        }

        $manager->flush();
    }
}

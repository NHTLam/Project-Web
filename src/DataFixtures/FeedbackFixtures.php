<?php

namespace App\DataFixtures;

use App\Entity\Feedback;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class FeedbackFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=1; $i<=3; $i++){
            $feedback = new Feedback;
            $feedback->getGrade((float)(rand(0,100)));
            $feedback->getComment("Comment for assigment $i");
            $feedback->getDateFeedback(\DateTime::createFromFormat('Y/m/d', '2022/07/01'));
            $manager->persist($feedback);            
        }

        $manager->flush();
    }
}

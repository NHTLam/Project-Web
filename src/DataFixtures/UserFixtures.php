<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct (UserPasswordHasherInterface $hasher) {
        $this->hasher = $hasher;
    }
    
    public function load(ObjectManager $manager): void
    {
        $user = new User;
        $user->setUuid("Student");
        $user->setPassword($this->hasher->hashPassword($user,"123456"));
        $user->setRoles(['ROLE_STUDENT']);
        $manager->persist($user);

        $user = new User;
        $user->setUuid("Admin");
        $user->setPassword($this->hasher->hashPassword($user,"123456"));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        $user = new User;
        $user->setUuid("Lecturer");
        $user->setPassword($this->hasher->hashPassword($user,"123456"));
        $user->setRoles(['ROLE_LECTURER']);
        $manager->persist($user);
       
        $manager->flush();
    }
}

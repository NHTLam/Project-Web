<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    // Tao ma hoa mat khau
    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        // tao role user
        $user = new User;
        $user->setUsername("User");
        $user->setPassword($this->hasher->hashPassword($user, "123456"));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        // tao role user
        $user = new User;
        $user->setUsername("Admin");
        $user->setPassword($this->hasher->hashPassword($user, "123456"));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        // tao role user
        $user = new User;
        $user->setUsername("Manager");
        $user->setPassword($this->hasher->hashPassword($user, "123456"));
        $user->setRoles(['ROLE_MANAGER']);
        $manager->persist($user);

        $manager->flush();
    }
}

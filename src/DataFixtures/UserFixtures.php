<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private array $usernames = ['and31', 'kassoul31', 'Armand2009', 'steven31270', 'Simonus_le_grand'];

    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setNickname('La_taupe');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, '123'));
        $admin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);

        foreach ($this->usernames as $username) {
            $contributor = new User();
            $contributor->setNickname($username);
            $contributor->setPassword($this->passwordHasher->hashPassword($contributor, '123'));
            $contributor->setRoles(["ROLE_CONTRIBUTOR"]);
            $manager->persist($contributor);
        }

        $user = new User();
        $user->setNickname('Ahmedzidanamz');
        $user->setPassword($this->passwordHasher->hashPassword($user, '123'));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $manager->flush();
    }
}

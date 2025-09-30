<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{

    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $contributer = new User();

        $plainPassword = "nepasutilisercemotdepasse";
        $hashedPassword = $this->passwordHasher->hashPassword($contributer, $plainPassword);

        $contributer->setPassword($hashedPassword);
        $contributer->setEmail("exemple123@blabla.fr");
        $contributer->setRoles(['ROLE_USER']);

        $admin = new User();

        $plainPassword = "lepiremotdepasseadminaumonde";
        $hashedPassword = $this->passwordHasher->hashPassword($admin, $plainPassword);
        
        $admin->setPassword($hashedPassword);
        $admin->setEmail("admin@boulot.fr");
        $admin->setRoles(['ROLE_USER', 'ROLE_ADMIN']);

        $manager->persist($contributer);
        $manager->persist($admin);

        $manager->flush();
    }
}

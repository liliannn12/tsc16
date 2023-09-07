<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $passwordEncoder, private SluggerInterface $slugger) {}
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setLastname('POIGNAT');
        $admin->setFirstname('Jérôme');
        $admin->setEmail('jerome.poignat@bbox.fr');
        $admin->setPhone('0608325649');
        $admin->setAddress('Zone des Tuileries');
        $admin->setZipcode('16400');
        $admin->setCity('La Couronne');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'JPoignatAdmin16')
        );
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);
        $manager->flush();
    }
}

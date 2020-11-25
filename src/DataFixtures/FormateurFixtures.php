<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Formateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FormateurFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $profil = $this ->getReference('p2');
        if (isset($profil)) {
            for ($i=0; $i < 4; $i++) { 
                $user = new Formateur();
                $password = $this -> encoder->encodePassword($user, 'passer1234');
                $user->setProfil($profil);
                $user->setUsername("formateur$i");
                $user->setNom($faker->lastName);
                $user->setPrenom($faker->firstName);
                $user->setPhone($faker->phoneNumber);
                $user->setEmail($faker->email);
                $user->setStatus(1);
                $user->setPhoto($faker->image());
                $user->setPassword($password);
                $manager->persist($user);
                
            }
        }
        

        $manager->flush();
    }

    public function getDependencies()
    {
       return array(ProfilFixtures::class); 
    }
}

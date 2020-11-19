<?php

namespace App\DataFixtures;

use App\Entity\Apprenant;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ApprenantFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        $profil = $this ->getReference('p1');
        if (isset($profil)) {
            for ($i=0; $i < 4; $i++) { 
                $user = new Apprenant();
                $password = $this -> encoder->encodePassword($user, 'passer1234');
                $user->setProfil($profil);
                $user->setUsername("apprenant$i");
                $user->setNom($faker->lastName);
                $user->setPrenom($faker->firstName);
                $user->setPhone($faker->phoneNumber);
                $user->setEmail($faker->email);
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

<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfilFixtures extends Fixture
{
    public const ADMIN ='admin', APPRENANT = 'apprenant', FORMATEUR = 'formateur', CM = 'cm';
    public function load(ObjectManager $manager)
    {

        $profils =["ADMIN", "FORMATEUR", "APPRENANT", "CM"];
        foreach ($profils as $key => $value) {
            $profil = new profil();
            $profil->setLibelle($value)
                ->setStatus(1);         
            $manager ->persist($profil);
            $this->addReference("p$key", $profil);
            $manager->flush();
        }
           
        
       
    }
}

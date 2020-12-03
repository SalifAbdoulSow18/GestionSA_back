<?php

namespace App\DataFixtures;

use App\Entity\ProfilDeSortie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfilDeSortieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $profilsorties =["DEVELOPPEUR FRONT","DEVELOPPEUR BACK","DEVELOPPEUR FULLSTACK","CMS","DESIGNER","INTEGRATEUR"];

        foreach ($profilsorties as $key => $libelle){

            $profilsorti =new ProfilDeSortie() ;
            $profilsorti ->setLibelle ($libelle );
            $manager->persist($profilsorti);

        }
        $manager->flush();
    }
}

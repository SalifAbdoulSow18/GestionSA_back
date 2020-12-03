<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Referentiel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ReferentielFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 3; $i++) {
            $ref = new Referentiel();
            $ref
                    ->setLibelle("referentiel n°$i")
                    ->setPresentation("presentation n°$i")
                    ->setCritereAdmission("critereAdmission n°$i")
                    ->setCritereEvaluation("critereEvaluation n°$i");

            $manager->persist($ref);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}

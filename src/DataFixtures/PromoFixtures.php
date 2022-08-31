<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Promo;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PromoFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i=0; $i < 3; $i++) {
            $promotion = new Promo();
            $promotion
                    ->setLibelle("promo n°$i")
                    ->setAnnee(new \DateTime())
                    ->setDateDebut(new \DateTime())
                    ->setDateFin(new \DateTime());

            $manager->persist($promotion);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}

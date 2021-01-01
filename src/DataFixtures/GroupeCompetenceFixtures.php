<?php

namespace App\DataFixtures;

use App\Entity\Competence;
use App\Entity\GroupeCompetence;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupeCompetenceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < 2; $i++) { 
            $groupeCompetence = (new GroupeCompetence())
                            ->setLibelle("GroupeCompetence" .$i)
                            ->setStatus(1)
                            ->setDescription("description" .$i);
            for ($j=0; $j < 3; $j++) { 
                $competence = new Competence();
                $competence->setNomCompetence("competence$i" .$j);
                $competence->setStatus(1);
                $groupeCompetence->addCompetence($competence);
                $manager->persist($competence);
            } 
                $manager->persist($groupeCompetence);
        }

        $manager->flush();
    }
}

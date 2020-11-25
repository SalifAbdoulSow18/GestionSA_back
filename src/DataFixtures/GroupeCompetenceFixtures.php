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
        for ($i=0; $i < 4; $i++) { 
            $groupeCompetence = (new GroupeCompetence())
                            ->setLibelle("GroupeCompetence" .$i)
                            ->setDescription("description" .$i);
            for ($j=0; $j < 4; $j++) { 
                $competence = new Competence();
                $competence->setNomCompetence("competence" .$j);
                $groupeCompetence->addCompetence($competence);
                $manager->persist($competence);
            } 
                $manager->persist($groupeCompetence);
        }

        $manager->flush();
    }
}

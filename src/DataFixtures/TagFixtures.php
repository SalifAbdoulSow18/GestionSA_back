<?php

namespace App\DataFixtures;

use App\Entity\GroupeTag;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($j=1; $j <= 4 ; $j++) { 
            $groupeTag = new GroupeTag();
            $groupeTag->setLibelle("groupeTag" .$j);
        
            for ($i=0; $i < 5 ; $i++) { 
                $tag = new Tag();
                $tag->setLibelle("tag" .$i);
                $groupeTag->addTag($tag);
                
    
            }

            $manager->persist($groupeTag);
        // $product = new Product();
        // $manager->persist($product);       
        }
        
        $manager->flush();
    }
}

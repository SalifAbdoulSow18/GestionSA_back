<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\GroupeTag;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupeTagController extends AbstractController
{
    /**
     * @Route(
     *     path="/api/admin/groupe_tags",
     *      name="added",
     *     methods={"POST"},
     *     defaults={
     *      "_api_resource_class"=GroupeTag::class,
     *      "_api_collection_operation_name"="addGrpTag"
     *     }
     *     )
     */

    public function addGroupeTag(TagRepository $tagRepo,SerializerInterface $serializer, EntityManagerInterface $manager, Request $request)
    {
        $grptag = json_decode($request->getContent(), true);
       
        $groupetag = new GroupeTag();
        $groupetag->setLibelle($grptag["libelle"]);
  
        foreach ($grptag["tags"] as $value) {
            
            if (isset($value["libelle"])) {
                
                //$compet=$tagRepo->find((int)$value["id"]);
                $compet=$tagRepo->findOneBy(['libelle'=>$value['libelle']]);  
                if (isset($compet)) {
                    $groupetag->addTag($compet);
                    $manager->persist($groupetag);
                }
                else {
                    $tag = new Tag();
                    $tag->setLibelle($value["libelle"]);
                    $manager->persist($tag);
                    $groupetag->addtag($tag);
                    //return $this->json("failed",Response::HTTP_NOT_FOUND);
                }                
            }
        }
            $manager->flush();
            return $this->json("success",Response::HTTP_OK);
    }
}



<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Entity\GroupeCompetence;
use App\Repository\CompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupeCompetenceController extends AbstractController
{
    
     /**
     * @Route(
     *     path="/api/admin/groupe_competences",
     *     name="creer",
     *     methods={"POST"},
     *     defaults={
     *      "_api_resource_class"=GroupeCompetence::class,
     *      "_api_collection_operation_name"="addGrpComp"
     *     }
     *     )
     */

    public function addGroupeCompetence(CompetenceRepository $competenceRepo,SerializerInterface $serializer, EntityManagerInterface $manager, Request $request)
    {
        $grpcompetence = json_decode($request->getContent(), true);
        
        $groupecompetence = new GroupeCompetence();
        $groupecompetence->setLibelle($grpcompetence["libelle"])
                         ->setDescription($grpcompetence['description']);
        
        foreach ($grpcompetence["competence"] as $value) {
            
            if (isset($value["id"])) {
                
                $compet=$competenceRepo->find((int)$value["id"]);  
                if (isset($compet)) {
                    $groupecompetence->addCompetence($compet);
                    $manager->persist($groupecompetence);
                }
                else {
                    return $this->json("failed",Response::HTTP_NOT_FOUND);
                }                
            }
        }
               $manager->flush();
            return $this->json("success",Response::HTTP_OK);
    }
}

            // if(isset($value['nomCompetence'])) {
            //     $competence = new Competence();
            //     $competence->setNomCompetence($value["nomCompetence"]);
            //     $manager->persist($competence);
            //     $groupecompetence->addCompetence($competence);
                
            // }
       
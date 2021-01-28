<?php

namespace App\Controller;

use App\Entity\Referentiel;
use App\Repository\GroupeCompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReferentielController extends AbstractController
{
    //  /**
    //  * @Route(
    //  *      name="referentiel_gpecompetence",
    //  *      path="api/admin/referentiels",
    //  *      methods={"POST"},
    //  *      defaults={
    //  *          "_api_resource_class"=Referentiel::class,
    //  *          "_api_collection_operation_name"="addReferent"
    //  *     }
    //  * )
    //  */
    // public function addReferentiel(GroupeCompetenceRepository $groupeCompetenceRepository ,SerializerInterface $serializer, EntityManagerInterface $manager, Request $request) {

    //         $ref = json_decode($request->getContent(), true);
       
    //     $referentiel = new Referentiel();
    //     $referentiel->setLibelle($ref["libelle"])
    //                      ->setPresentation($ref['presentation'])
    //                      ->setCritereAdmission($ref['critereAdmission'])
    //                      ->setCritereEvaluation($ref['critereEvaluation']);
        
    //     foreach ($ref["groupeCompetences"] as $value) {
            
    //         if (isset($value["id"])) {
                
    //             $referent=$groupeCompetenceRepository->find((int)$value["id"]); 
                
    //             if (isset($referent)) {
    //                 $referentiel->addGroupeCompetence($referent);
    //                 $manager->persist($referentiel);
    //             }
    //             else {
    //                 return $this->json("failed",Response::HTTP_NOT_FOUND);
    //             }                
    //         }
    //     }
    //            $manager->flush();
    //         return $this->json("success",Response::HTTP_OK);
        
    // }

}

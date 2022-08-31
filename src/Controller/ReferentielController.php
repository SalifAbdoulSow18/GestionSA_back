<?php

namespace App\Controller;

use App\Entity\Referentiel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GroupeCompetenceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ReferentielController extends AbstractController
{
  /**
     * @Route(
     *     name="addReferentiel",
     *     path="/api/admin/referentiels",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\ReferentielController::addReferentiel",
     *          "__api_resource_class"="App\Entity\Referentiel::class",
     *          "__api_collection_operation_name"="addReferentiel"
     *     }
     * )
     */
    public function addReferentiel(Request $request, DenormalizerInterface $denormalizer, EntityManagerInterface $manager, GroupeCompetenceRepository $groupeCmp) {
        $ref = $request->request->all();
        $referentiel = $denormalizer->denormalize($ref, Referentiel::class, true);
        //dd($referentiel);
        $p = $request->files->get('programme');
        if ($p) {
            $p1 = $p->getRealPath();
            $p2 = fopen($p1, 'r+');
            $referentiel->setProgramme($p2);
        }
        if ($ref['groupeCompetence']){
            $array = explode (',', $ref['groupeCompetence']);
            //dd($array);
            for ($i=0; $i < count($array)-1; $i++) {
                 
                if ($groupeCmp->findOneBy(['id'=>(int)$array[$i]])) {
                    $referentiel->addGroupeCompetence($groupeCmp->findOneBy(['id'=>(int)$array[$i]]));
                    //dd($groupeCmp->findOneBy(['id'=>(int)$array[$i]]));
                }
            }
        }
        $manager->persist($referentiel);
        $manager->flush();
        return $this->json("success", 201);
    }


     /**
     * @Route(
     *     name="editReferentiel",
     *     path="/api/admin/referentiels/{id}",
     *     methods={"PUT"},
     *     defaults={
     *          "__controller"="App\Controller\ReferentielController::editReferentiel",
     *          "__api_resource_class"="App\Entity\Referentiel::class",
     *          "__api_item_operation_name"="editReferentiel"
     *     }
     * )
     */
    public function editReferentiel(Request $request, DenormalizerInterface $denormalizer, EntityManagerInterface $manager, GroupeCompetenceRepository $groupeCmp, $id) {
        $ref = $request->getContent();
        //dd($ref);
        $referentiel = [];
        $data = preg_split("/form-data; /", $ref);
        unset($data[0]);
        foreach ($data as $value) {
            $data1 = preg_split("/\r\n/", $value);
            //dd($data1);
            array_pop($data1);
            array_pop($data1);
            $data2 = explode('"', $data1[0]);
            //dd($data1);
            // if ($data2[1] == 'programme') {
            //     dd($data1);
            // }
            $referentiel[$data2[1]] = end($data1);
            //dd($referentiel);
        } 
        $refModif = $manager->getRepository(Referentiel::class)->find($id);
        foreach ($referentiel as $key => $value) {
            if ($key !== 'groupeCompetence') {
                $set = 'set'.ucfirst(strtolower($key));
                $refModif->$set($value);

            } else {
                foreach ($refModif->getGroupeCompetences() as $value) {
                    $refModif->removeGroupeCompetence($value);
                }
                $array = explode (',', $referentiel['groupeCompetence']);
                //dd($array);
                for ($i=0; $i < count($array)-1; $i++) {
                     
                    if ($groupeCmp->findOneBy(['id'=>(int)$array[$i]])) {
                        $refModif->addGroupeCompetence($groupeCmp->findOneBy(['id'=>(int)$array[$i]]));
                        //dd($groupeCmp->findOneBy(['id'=>(int)$array[$i]]));
                    }
                }
            }
        }
        $manager->flush();
        return $this->json("success", 201);
        
        
    }
}
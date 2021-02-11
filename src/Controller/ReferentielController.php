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
    public function addReferentiel(Request $request, DenormalizerInterface $denormalizer, EntityManagerInterface $manager) {
        $ref = $request->request->all();
        $referentiel = $denormalizer->denormalize($ref, Referentiel::class, true);
        $p = $request->files->get('programme');
        if ($p) {
            $p1 = $p->getRealPath();
            $p2 = fopen($p1, 'r+');
            $referentiel->setProgramme($p2);
        }
        $manager->persist($referentiel);
        $manager->flush();
        return $this->json("success", 201);
    }
}

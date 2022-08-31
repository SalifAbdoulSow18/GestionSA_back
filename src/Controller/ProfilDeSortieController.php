<?php

namespace App\Controller;

use App\Repository\PromoRepository;
use App\Repository\ApprenantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilDeSortieController extends AbstractController
{
    /**
     * 
     * @Route(
     *     name="getApprenantOfOnePromoByProfilsortie",
     *     path="/api/admin/promo/{id}/profilsorties",
     *     methods={"GET"},
     *     defaults={
     *          "__controller"="App\Controller\ProfilSortieController::showApprenantOfOneGroupeByProfilsortie",
     *          "__api_resource_class"=ProfilSortie::class,
     *          "__api_collection_operation_name"="show_profilsortie_by_groupe"
     *     }
     * )
     */

    public function showApprenantOfOneGroupeByProfilsortie ($id, ApprenantRepository $apprenantRepository,PromoRepository $promoRepository){
        $apprenants = $apprenantRepository->findBy(["promo"=>$id]);
        return $this->json($apprenants, 200, [], ["groups" => ["apprenant_promo_profilsortie"]]);
    }



    /**
     * 
     * @Route(
     *     name="getApprenantofOneProfilsortieOfOnePromo",
     *     path="/api/admin/promo/{id1}/profilsorties/{id2}",
     *     methods={"GET"},
     *     defaults={
     *          "__controller"="App\Controller\ProfilSortieController::showApprenantOfOneProfilsortieOfOnPromo",
     *          "__api_resource_class"=ProfilSortie::class,
     *          "__api_item_operation_name"="show_profilsortie_promo"
     *     }
     * )
     */

    public function showApprenantOfOneProfilsortieOfOnPromo ($id1, $id2, ApprenantRepository $apprenantRepository, PromoRepository $promoRepository){
        $apprenants = $apprenantRepository->findBy(["promo"=>$id1,"profilSortie"=>$id2]);   
        return $this->json($apprenants, 200, [], ["groups" => ["apprenant_profilsortie_promo"]]);
                 
    }

}

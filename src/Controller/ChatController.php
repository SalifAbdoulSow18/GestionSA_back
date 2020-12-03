<?php

namespace App\Controller;

use App\Repository\ChatRepository;
use App\Repository\UserRepository;
use App\Repository\PromoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChatController extends AbstractController
{
     /**
     * 
     * @Route(
     *     name="getChatOfOneApprenantOfOnePromo",
     *     path="/api/users/promo/{id1}/apprenant/{id2}/chats",
     *     methods={"GET"},
     *     defaults={
     *          "__controller"="App\Controller\ChatController::showChatOfOneApprenantOfOnPromo",
     *          "__api_resource_class"=Chat::class,
     *          "__api_collection_operation_name"="show_chat_apprenant_promo"
     *     }
     * )
     */

    public function showChatOfOneApprenantOfOnPromo (ChatRepository $chatRepository, $id1, $id2, UserRepository $userRepository, PromoRepository $promoRepository)
    {
       $promo= $promoRepository->find($id1);
       $user= $userRepository->find($id2);
       if ($user->getProfil()->getLibelle()=="APPRENANT") {
           
          return $this->json($user->getChats());
       }
       else{
        return $this->json("Vous n'êtes pas un apprenant");
       }
    }



    /**
     * 
     * @Route(
     *     name="postChatOfOneApprenantOfOnePromo",
     *     path="/api/users/promo/{id1}/apprenant/{id2}/chats",
     *     methods={"POST"},
     *     defaults={
     *          "__controller"="App\Controller\ChatController::creatChatOfOneApprenantOfOnPromo",
     *          "__api_resource_class"=Chat::class,
     *          "__api_collection_operation_name"="creat_chat_apprenant_promo"
     *     }
     * )
     */

    public function creatChatOfOneApprenantOfOnPromo (Request $request,SerializerInterface $serializer,PromoRepository $promoRepository,UserRepository $userRepository,$id1,$id2,ChatRepository $chatRepository, EntityManagerInterface $manager)
    {
        $json = json_decode($request->getContent(), true);
        $promo= $promoRepository->find($id1);
        $user= $userRepository->find($id2);
        if ($user->getProfil()->getLibelle()==="APPRENANT") {

            $chat = $serializer->denormalize($json, Chat::class);

            $manager->persist($chat);
            $manager->flush();
        return new JsonResponse("succes",Response::HTTP_CREATED,[],true);
            
        }else {
            return new Response("Amoul!!!");
        }
    }
}

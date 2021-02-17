<?php

namespace App\Controller;

use App\Service\UserService;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;
    /**
     * @var SerializerInterface
     */
    private  $serializer;

    /**
     * AdminController constructor.
     */
    public function __construct(EntityManagerInterface $manager,SerializerInterface $serializer)
    {
        $this->manager = $manager;
        $this->serializer = $serializer;
    }
//L'ajout d'un utilisateur en fonction deson type!!!
    /**
     * @Route(
     *     "api/admin/users",
     *      name="adding",
     *     methods={"POST"},
     *     defaults={
     *      "_api_resource_class"=User::class,
     *      "_api_collection_operation_name"="addUser"
     *     }
     *     )
     */
    public function AddUser(UserService $userService, Request $request)
    {
       $image = $request->files->get('photo');
       $image = fopen($image->getRealPath(), 'rb');
       $type = $request->get("type");
       $utilisateur = $userService->NewUser($type,$request);
       // dd($utilisateur);
       $utilisateur->setStatus(1);
        if (!empty($userService->ValidatePost($utilisateur))){
            return $this->json($userService->ValidatePost($utilisateur),400);
        }
        //dd($utilisateur);
        $utilisateur->setPhoto($image);
        $this->manager->persist($utilisateur);
         $this->manager->flush();
        //$this->sendEmail->send($utilisateur->getEmail(),"registration",'your registration has been successfully completed');
        return $utilisateur;
    }

//La modification d'un utilisateur en fonction de son id!!!

    /**
     * @Route(
     *     path="/api/admin/users/{id}",
     *     name="modification",
     *     methods={"PUT"},
     *     )
     */
    public function modifyUser(Request $request, $id, UserService $userService, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);
        
        $data_user=$request->request->all();
         return $this->json($data_user,400);
        foreach($data_user as $key => $value)
        {
            if($key!=='_method')
            {
               $user->{"set".ucfirst($key)}($value);
            }
        }
        $uploadedFile = $request->files->get('photo');
        if($uploadedFile){
            $file = $uploadedFile->getRealPath();
            $photo = fopen($file,'r+');
            $user->setPhoto($photo);
        }
        if (!empty($userService->ValidatePost($user))){
            return $this->json($userService->ValidatePost($user),400);
        }
        //dd($utilisateur);
        $this->manager->flush();                
        return $this->json("success",200);
    }

}

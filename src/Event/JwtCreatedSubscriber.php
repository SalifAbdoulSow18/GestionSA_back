<?php

namespace App\Event;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedSubscriber
{

    public function updateJwtData(JWTCreatedEvent $event) {
        //Recuperation de l'utilisateur 
        $user = $event->getUser();

        //Surchage des donnees du Token 
        $data =$event->getData();

        $data['status'] = $user->getStatus();

        // Revoie des donnees du Token 

        $event->setData($data);

    }
}
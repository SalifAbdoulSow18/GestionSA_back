<?php

namespace App\Entity;

use App\Entity\User;
use App\Repository\CmRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CmRepository::class)
 */
class Cm extends User
{
    
}

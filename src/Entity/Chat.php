<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ChatRepository;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ChatRepository::class)
 * @ApiResource(
 * 
 * attributes={
 *      "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM') or is_granted('ROLE_APPRENANT'))",
 *      "security_message" = "vous n'avez pas accès a cette resource"
 * },
 * 
 * collectionOperations={
 * 
 *      "show_chat_apprenant_promo"={
 *          "method"= "GET",
 *          "path" = "/users/promo/{id1}/apprenant/{id2}/chats",
 *          "route_name"="getChatOfOneApprenantOfOnePromo",
 *      },
 * 
 *     "creat_chat_apprenant_promo"={
 *          "method"= "POST",
 *          "path" = "/users/promo/{id1}/apprenant/{id2}/chats",
 *          "route_name"="postChatOfOneApprenantOfOnePromo",
 *      }
 * },
 * itemOperations={}
 * )
 */
class Chat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $piecesJointes;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="chats")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="chats")
     */
    private $promo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getPiecesJointes(): ?string
    {
        return $this->piecesJointes;
    }

    public function setPiecesJointes(string $piecesJointes): self
    {
        $this->piecesJointes = $piecesJointes;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getPromo(): ?Promo
    {
        return $this->promo;
    }

    public function setPromo(?Promo $promo): self
    {
        $this->promo = $promo;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeTagRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=GroupeTagRepository::class)
 * @ApiResource(
 *      attributes={
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "security_message"="Vous n'avez pas access à cette Ressource"
 *      },
 *   routePrefix="/admin",
 *      collectionOperations={
 *          "get",
 *      "addGrpTag":{
 * 
 *              "route_name"="added",
 *              "method"="POST",
 *              "path":"/admin/groupe_tags",
 *               "access_control"="(is_granted('ROLE_ADMIN') )",
 *              }
 *      },
 *      itemOperations={
 *          "get",
 *      "modifierGrpetag"={
 *              "normalization_context"={"groups"={"grptag:read"}},
 *              "denormalization_context"={"groups"={"grptag:write"}},
 *              "method"="PUT"
 *          },
 *      }
 * )
 * @UniqueEntity("libelle", message="l'adress libelle doit être unique")
 */
class GroupeTag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="groupeTags", cascade={"persist"})
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @ApiSubresource
     * @Groups({"grptag:write"})
     */
    private $tag;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Groups({"grptag:write"})
     */
    private $libelle;

    public function __construct()
    {
        $this->tag = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTag(): Collection
    {
        return $this->tag;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tag->contains($tag)) {
            $this->tag[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->tag->removeElement($tag);

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProfilDeSortieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ProfilDeSortieRepository::class)
 * @ApiResource(
 * collectionOperations={
 * "get_profils_sortie"={
 *          "method"= "GET",
 *          "path" = "/admin/profilsorties",
 *          "normalization_context"={"groups"={"list_profil_sortie:read"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))"
 *      },
 * 
 *      "create_profils_sortie"={
 *          "method"= "POST",
 *          "path" = "/admin/profilsorties",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 * 
 *     "show_profilsortie_by_groupe"={
 *          "method"= "GET",
 *          "path" = "/admin/promo/{id}/profilsorties",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))",
 *          "route_name"="getApprenantOfOnePromoByProfilsortie",
 *      }
 * },
 * 
 * itemOperations={
 *       "delete_profils_sortie"={
 *          "method"= "DELETE",
 *          "path" = "/admin/profilsorties/{id}",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))"
 *      },
 *  
 *      "get_one_profils_sortie"={
 *          "method"= "GET",
 *          "path" = "/admin/profilsorties/{id}",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))"
 *      },
 * 
 *      "edit_profils_sortie"={
 *          "method"= "PUT",
 *          "path" = "/admin/profilsorties/{id}",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 *      "delete",
 *     "show_profilsortie_promo"={
 *          "method"= "GET",
 *          "path" = "/admin/promo/{id1}/profilsorties/{id2}",
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR') or is_granted('ROLE_CM'))",
 *          "route_name"="getApprenantofOneProfilsortieOfOnePromo",
 *      }
 * }
 * )
 * @UniqueEntity("libelle", message="l'adress libelle doit être unique"),
 * @ApiFilter(SearchFilter::class, properties={"status": "exact"})
 */
class ProfilDeSortie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_profil_sortie:read","apprenant_promo_profilsortie"})
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Apprenant::class, inversedBy="profilDeSorties")
     */
    private $apprenants;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Groups({"list_profil_sortie:read","apprenant_promo_profilsortie"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function __construct()
    {
        $this->status = true;
        $this->apprenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getApprenants(): Collection
    {
        return $this->apprenants;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->apprenants->contains($apprenant)) {
            $this->apprenants[] = $apprenant;
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        $this->apprenants->removeElement($apprenant);

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

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
}

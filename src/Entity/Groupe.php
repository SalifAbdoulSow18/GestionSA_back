<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GroupeRepository::class)
 * @ApiResource(
 * collectionOperations={
 * "list_groupe"={
 *          "method"= "GET",
 *          "path" = "/admin/groupes",
 *          "normalization_context"={"groups"={"list_groupe:read"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 * "list_groupe_apprenant"={
 *          "method"= "GET",
 *          "path" = "/admin/groupes/apprenants",
 *          "normalization_context"={"groups"={"list_groupe_apprenant:read"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 * "add_groupe"={
 *          "method"= "POST",
 *          "path" = "/admin/groupes",
 *          "denormalization_context"={"groups"={"add_groupe:write"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 * },
 * itemOperations={
 * "list_one_groupe_apprenant"={
 *          "method"= "GET",
 *          "path" = "/admin/groupes/{id}",
 *          "normalization_context"={"groups"={"list_one_groupe_apprenant:read"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 * "modify_groupe"={
 *          "method"= "PUT",
 *          "path" = "/admin/groupes/{id}",
 *          "denormalization_context"={"groups"={"modify_groupe:write"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 * }
 * )
 */
class Groupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_groupe:read","list_groupe_apprenant:read","list_one_groupe_apprenant:read"})
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=EtatBriefGroupe::class, mappedBy="groupe")
     */
    private $etatBriefGroupe;

    /**
     * @ORM\ManyToMany(targetEntity=Formateur::class, inversedBy="groupes")
     * @Groups({"list_groupe:read","add_groupe:write"})
     */
    private $formateur;

    /**
     * @ORM\ManyToMany(targetEntity=Apprenant::class, inversedBy="groupes")
     * @Groups({"list_groupe:read","modify_groupe:write","list_groupe_apprenant:read","add_groupe:write"})
     */
    private $apprenant;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"list_groupe:read","modify_groupe:write","list_groupe_apprenant:read","add_groupe:write","list_one_groupe_apprenant:read"})
     */
    private $nomGroupe;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="groupes")
     * @Groups({"list_groupe:read"})
     */
    private $promos;

    public function __construct()
    {
        $this->etatBriefGroupe = new ArrayCollection();
        $this->formateur = new ArrayCollection();
        $this->apprenant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|EtatBriefGroupe[]
     */
    public function getEtatBriefGroupe(): Collection
    {
        return $this->etatBriefGroupe;
    }

    public function addEtatBriefGroupe(EtatBriefGroupe $etatBriefGroupe): self
    {
        if (!$this->etatBriefGroupe->contains($etatBriefGroupe)) {
            $this->etatBriefGroupe[] = $etatBriefGroupe;
            $etatBriefGroupe->setGroupe($this);
        }

        return $this;
    }

    public function removeEtatBriefGroupe(EtatBriefGroupe $etatBriefGroupe): self
    {
        if ($this->etatBriefGroupe->removeElement($etatBriefGroupe)) {
            // set the owning side to null (unless already changed)
            if ($etatBriefGroupe->getGroupe() === $this) {
                $etatBriefGroupe->setGroupe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Formateur[]
     */
    public function getFormateur(): Collection
    {
        return $this->formateur;
    }

    public function addFormateur(Formateur $formateur): self
    {
        if (!$this->formateur->contains($formateur)) {
            $this->formateur[] = $formateur;
        }

        return $this;
    }

    public function removeFormateur(Formateur $formateur): self
    {
        $this->formateur->removeElement($formateur);

        return $this;
    }

    /**
     * @return Collection|Apprenant[]
     */
    public function getApprenant(): Collection
    {
        return $this->apprenant;
    }

    public function addApprenant(Apprenant $apprenant): self
    {
        if (!$this->apprenant->contains($apprenant)) {
            $this->apprenant[] = $apprenant;
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        $this->apprenant->removeElement($apprenant);

        return $this;
    }

    public function getNomGroupe(): ?string
    {
        return $this->nomGroupe;
    }

    public function setNomGroupe(string $nomGroupe): self
    {
        $this->nomGroupe = $nomGroupe;

        return $this;
    }

    public function getPromos(): ?Promo
    {
        return $this->promos;
    }

    public function setPromos(?Promo $promos): self
    {
        $this->promos = $promos;

        return $this;
    }
}

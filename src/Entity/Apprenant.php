<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ApprenantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApprenantRepository::class)
 * @ApiResource(
 * attributes={
 *       "security"="is_granted('ROLE_ADMIN')",
 *       "security_message"="Vous n'avez pas access à cette Ressource"
 * },
 * collectionOperations={
 *     "post"={"path"="/apprenants"},
 *}, 
 * itemOperations={
 *     "get"={"path"="/apprenants/{id}"} 
 *}
 * )
 */
class Apprenant extends User
{
    /**
     * @ORM\OneToMany(targetEntity=LivrableAttenduApprenant::class, mappedBy="apprenant")
     */
    private $livrableAttenduApprenants;

    /**
     * @ORM\OneToMany(targetEntity=ApprenantLivrablePartiel::class, mappedBy="apprenant")
     */
    private $apprenantLivrablePartiels;

    /**
     * @ORM\OneToMany(targetEntity=CompetencesValides::class, mappedBy="apprenant")
     */
    private $competencesValides;

    /**
     * @ORM\OneToMany(targetEntity=BriefApprenant::class, mappedBy="apprenant")
     */
    private $briefApprenants;

    /**
     * @ORM\ManyToMany(targetEntity=Groupe::class, mappedBy="apprenant")
     */
    private $groupes;

    public function __construct()
    {
        $this->livrableAttenduApprenants = new ArrayCollection();
        $this->apprenantLivrablePartiels = new ArrayCollection();
        $this->competencesValides = new ArrayCollection();
        $this->briefApprenants = new ArrayCollection();
        $this->groupes = new ArrayCollection();
    }

    /**
     * @return Collection|LivrableAttenduApprenant[]
     */
    public function getLivrableAttenduApprenants(): Collection
    {
        return $this->livrableAttenduApprenants;
    }

    public function addLivrableAttenduApprenant(LivrableAttenduApprenant $livrableAttenduApprenant): self
    {
        if (!$this->livrableAttenduApprenants->contains($livrableAttenduApprenant)) {
            $this->livrableAttenduApprenants[] = $livrableAttenduApprenant;
            $livrableAttenduApprenant->setApprenant($this);
        }

        return $this;
    }

    public function removeLivrableAttenduApprenant(LivrableAttenduApprenant $livrableAttenduApprenant): self
    {
        if ($this->livrableAttenduApprenants->removeElement($livrableAttenduApprenant)) {
            // set the owning side to null (unless already changed)
            if ($livrableAttenduApprenant->getApprenant() === $this) {
                $livrableAttenduApprenant->setApprenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ApprenantLivrablePartiel[]
     */
    public function getApprenantLivrablePartiels(): Collection
    {
        return $this->apprenantLivrablePartiels;
    }

    public function addApprenantLivrablePartiel(ApprenantLivrablePartiel $apprenantLivrablePartiel): self
    {
        if (!$this->apprenantLivrablePartiels->contains($apprenantLivrablePartiel)) {
            $this->apprenantLivrablePartiels[] = $apprenantLivrablePartiel;
            $apprenantLivrablePartiel->setApprenant($this);
        }

        return $this;
    }

    public function removeApprenantLivrablePartiel(ApprenantLivrablePartiel $apprenantLivrablePartiel): self
    {
        if ($this->apprenantLivrablePartiels->removeElement($apprenantLivrablePartiel)) {
            // set the owning side to null (unless already changed)
            if ($apprenantLivrablePartiel->getApprenant() === $this) {
                $apprenantLivrablePartiel->setApprenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CompetencesValides[]
     */
    public function getCompetencesValides(): Collection
    {
        return $this->competencesValides;
    }

    public function addCompetencesValide(CompetencesValides $competencesValide): self
    {
        if (!$this->competencesValides->contains($competencesValide)) {
            $this->competencesValides[] = $competencesValide;
            $competencesValide->setApprenant($this);
        }

        return $this;
    }

    public function removeCompetencesValide(CompetencesValides $competencesValide): self
    {
        if ($this->competencesValides->removeElement($competencesValide)) {
            // set the owning side to null (unless already changed)
            if ($competencesValide->getApprenant() === $this) {
                $competencesValide->setApprenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BriefApprenant[]
     */
    public function getBriefApprenants(): Collection
    {
        return $this->briefApprenants;
    }

    public function addBriefApprenant(BriefApprenant $briefApprenant): self
    {
        if (!$this->briefApprenants->contains($briefApprenant)) {
            $this->briefApprenants[] = $briefApprenant;
            $briefApprenant->setApprenant($this);
        }

        return $this;
    }

    public function removeBriefApprenant(BriefApprenant $briefApprenant): self
    {
        if ($this->briefApprenants->removeElement($briefApprenant)) {
            // set the owning side to null (unless already changed)
            if ($briefApprenant->getApprenant() === $this) {
                $briefApprenant->setApprenant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(Groupe $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->addApprenant($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            $groupe->removeApprenant($this);
        }

        return $this;
    }
}

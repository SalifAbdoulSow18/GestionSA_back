<?php

namespace App\Entity;

use App\Repository\BriefMaPromoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BriefMaPromoRepository::class)
 */
class BriefMaPromo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Brief::class, inversedBy="briefMaPromos")
     */
    private $briefs;

    /**
     * @ORM\OneToMany(targetEntity=LivrablePartiel::class, mappedBy="briefMaPromo")
     */
    private $livrablePartiel;

    /**
     * @ORM\OneToMany(targetEntity=BriefApprenant::class, mappedBy="briefMaPromo")
     */
    private $briefApprenants;

    /**
     * @ORM\ManyToOne(targetEntity=Promo::class, inversedBy="briefMaPromo")
     */
    private $promo;

    public function __construct()
    {
        $this->livrablePartiel = new ArrayCollection();
        $this->briefApprenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBriefs(): ?Brief
    {
        return $this->briefs;
    }

    public function setBriefs(?Brief $briefs): self
    {
        $this->briefs = $briefs;

        return $this;
    }

    /**
     * @return Collection|LivrablePartiel[]
     */
    public function getLivrablePartiel(): Collection
    {
        return $this->livrablePartiel;
    }

    public function addLivrablePartiel(LivrablePartiel $livrablePartiel): self
    {
        if (!$this->livrablePartiel->contains($livrablePartiel)) {
            $this->livrablePartiel[] = $livrablePartiel;
            $livrablePartiel->setBriefMaPromo($this);
        }

        return $this;
    }

    public function removeLivrablePartiel(LivrablePartiel $livrablePartiel): self
    {
        if ($this->livrablePartiel->removeElement($livrablePartiel)) {
            // set the owning side to null (unless already changed)
            if ($livrablePartiel->getBriefMaPromo() === $this) {
                $livrablePartiel->setBriefMaPromo(null);
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
            $briefApprenant->setBriefMaPromo($this);
        }

        return $this;
    }

    public function removeBriefApprenant(BriefApprenant $briefApprenant): self
    {
        if ($this->briefApprenants->removeElement($briefApprenant)) {
            // set the owning side to null (unless already changed)
            if ($briefApprenant->getBriefMaPromo() === $this) {
                $briefApprenant->setBriefMaPromo(null);
            }
        }

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

<?php

namespace App\Entity;

use App\Repository\LivrablePartielRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivrablePartielRepository::class)
 */
class LivrablePartiel
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
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $delai;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbreRendu;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbreCorriger;

    /**
     * @ORM\ManyToMany(targetEntity=Niveau::class, inversedBy="livrablePartiels")
     */
    private $niveaux;

    /**
     * @ORM\OneToMany(targetEntity=ApprenantLivrablePartiel::class, mappedBy="livrablePartiel")
     */
    private $apprenantLivrablePartiels;

    /**
     * @ORM\ManyToOne(targetEntity=BriefMaPromo::class, inversedBy="livrablePartiel")
     */
    private $briefMaPromo;

    public function __construct()
    {
        $this->niveaux = new ArrayCollection();
        $this->apprenantLivrablePartiels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDelai(): ?string
    {
        return $this->delai;
    }

    public function setDelai(string $delai): self
    {
        $this->delai = $delai;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getNbreRendu(): ?int
    {
        return $this->nbreRendu;
    }

    public function setNbreRendu(int $nbreRendu): self
    {
        $this->nbreRendu = $nbreRendu;

        return $this;
    }

    public function getNbreCorriger(): ?int
    {
        return $this->nbreCorriger;
    }

    public function setNbreCorriger(int $nbreCorriger): self
    {
        $this->nbreCorriger = $nbreCorriger;

        return $this;
    }

    /**
     * @return Collection|Niveau[]
     */
    public function getNiveaux(): Collection
    {
        return $this->niveaux;
    }

    public function addNiveau(Niveau $niveau): self
    {
        if (!$this->niveaux->contains($niveau)) {
            $this->niveaux[] = $niveau;
        }

        return $this;
    }

    public function removeNiveau(Niveau $niveau): self
    {
        $this->niveaux->removeElement($niveau);

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
            $apprenantLivrablePartiel->setLivrablePartiel($this);
        }

        return $this;
    }

    public function removeApprenantLivrablePartiel(ApprenantLivrablePartiel $apprenantLivrablePartiel): self
    {
        if ($this->apprenantLivrablePartiels->removeElement($apprenantLivrablePartiel)) {
            // set the owning side to null (unless already changed)
            if ($apprenantLivrablePartiel->getLivrablePartiel() === $this) {
                $apprenantLivrablePartiel->setLivrablePartiel(null);
            }
        }

        return $this;
    }

    public function getBriefMaPromo(): ?BriefMaPromo
    {
        return $this->briefMaPromo;
    }

    public function setBriefMaPromo(?BriefMaPromo $briefMaPromo): self
    {
        $this->briefMaPromo = $briefMaPromo;

        return $this;
    }
}

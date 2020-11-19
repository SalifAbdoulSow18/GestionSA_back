<?php

namespace App\Entity;

use App\Repository\ApprenantLivrablePartielRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApprenantLivrablePartielRepository::class)
 */
class ApprenantLivrablePartiel
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
    private $etat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $delai;

    /**
     * @ORM\ManyToOne(targetEntity=Apprenant::class, inversedBy="apprenantLivrablePartiels")
     */
    private $apprenant;

    /**
     * @ORM\ManyToOne(targetEntity=LivrablePartiel::class, inversedBy="apprenantLivrablePartiels")
     */
    private $livrablePartiel;

    /**
     * @ORM\OneToOne(targetEntity=FilDeDiscution::class, cascade={"persist", "remove"})
     */
    private $filDeDiscution;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

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

    public function getApprenant(): ?Apprenant
    {
        return $this->apprenant;
    }

    public function setApprenant(?Apprenant $apprenant): self
    {
        $this->apprenant = $apprenant;

        return $this;
    }

    public function getLivrablePartiel(): ?LivrablePartiel
    {
        return $this->livrablePartiel;
    }

    public function setLivrablePartiel(?LivrablePartiel $livrablePartiel): self
    {
        $this->livrablePartiel = $livrablePartiel;

        return $this;
    }

    public function getFilDeDiscution(): ?FilDeDiscution
    {
        return $this->filDeDiscution;
    }

    public function setFilDeDiscution(?FilDeDiscution $filDeDiscution): self
    {
        $this->filDeDiscution = $filDeDiscution;

        return $this;
    }
}

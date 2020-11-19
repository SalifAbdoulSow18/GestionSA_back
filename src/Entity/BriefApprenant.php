<?php

namespace App\Entity;

use App\Repository\BriefApprenantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BriefApprenantRepository::class)
 */
class BriefApprenant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=Apprenant::class, inversedBy="briefApprenants")
     */
    private $apprenant;

    /**
     * @ORM\ManyToOne(targetEntity=BriefMaPromo::class, inversedBy="briefApprenants")
     */
    private $briefMaPromo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

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

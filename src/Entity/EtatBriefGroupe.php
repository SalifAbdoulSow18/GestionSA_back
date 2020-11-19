<?php

namespace App\Entity;

use App\Repository\EtatBriefGroupeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatBriefGroupeRepository::class)
 */
class EtatBriefGroupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Brief::class, inversedBy="etatBriefGroupes")
     */
    private $briefs;

    /**
     * @ORM\ManyToOne(targetEntity=Groupe::class, inversedBy="etatBriefGroupe")
     */
    private $groupe;

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

    public function getGroupe(): ?Groupe
    {
        return $this->groupe;
    }

    public function setGroupe(?Groupe $groupe): self
    {
        $this->groupe = $groupe;

        return $this;
    }
}

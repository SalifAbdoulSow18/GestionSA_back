<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GroupeCompetenceRepository;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=GroupeCompetenceRepository::class)
 * @ApiResource(
 *      attributes={
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "security_message"="Vous n'avez pas access à cette Ressource"
 *      },
 *   routePrefix="/admin",
 * collectionOperations={
 * "get",
 * "addGrpComp":{
 * 
 *              "route_name"="creer",
 *               "method"="POST",
 *              "path":"/admin/groupe_competences",
 *               "access_control"="(is_granted('ROLE_ADMIN'))",
 *              },
 * "listGrpComp":{
 * 
 *               "method"="GET",
 *              "path":"/admin/groupe_competences/competences",
 *              "normalization_context"={"groups"={"listgrpcomp:read"}},
 *              }
 * },
 *      itemOperations={
 *          "get",
 *          "modifierGrpeCompetence"={
 *              "normalization_context"={"groups"={"grpcomp:read"}},
 *              "denormalization_context"={"groups"={"grpcomp:write"}},
 *              "method"="PUT"
 *          },
 *      }
 * )
 * @UniqueEntity("libelle", message="l'adress libelle doit être unique")
 */
class GroupeCompetence
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"competence:read","ref:write","listgrpcomp:read","refgpecomp:read","referentiel_gpecompetence:read"})
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, mappedBy="groupeCompetence", cascade={"persist"})
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @ApiSubresource
     * @Groups({"gpecompcomp:read","listgrpcomp:read","grpcomp:write"})
     */
    private $competences;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Groups({"competence:read","listgrpcomp:read","refgpecomp:read","referentiel_gpecompetence:read","gpecompcomp:read","grpcomp:write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Ce champs est obligatoire")
     * @Groups({"competence:read","listgrpcomp:read","refgpecomp:read","referentiel_gpecompetence:read","gpecompcomp:read","grpcomp:write"})
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"competence:read","listgrpcomp:read","refgpecomp:read","referentiel_gpecompetence:read","gpecompcomp:read"})
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=Referentiel::class, inversedBy="groupeCompetences")
     */
    private $referentiels;

    public function __construct()
    {
        $this->status=true;
        $this->competences = new ArrayCollection();
        $this->referentiels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->addGroupeCompetence($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            $competence->removeGroupeCompetence($this);
        }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    /**
     * @return Collection|Referentiel[]
     */
    public function getReferentiels(): Collection
    {
        return $this->referentiels;
    }

    public function addReferentiel(Referentiel $referentiel): self
    {
        if (!$this->referentiels->contains($referentiel)) {
            $this->referentiels[] = $referentiel;
        }

        return $this;
    }

    public function removeReferentiel(Referentiel $referentiel): self
    {
        $this->referentiels->removeElement($referentiel);

        return $this;
    }
}

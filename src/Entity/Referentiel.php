<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReferentielRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ReferentielRepository::class)
 *  @ApiResource(
 *      attributes={
 *          "security"="is_granted('ROLE_ADMIN')||is_granted('ROLE_FORMATEUR')||is_granted('ROLE_CM')",
 *          "security_message"="Vous n'avez pas access à cette Ressource"
 *      },
 *      collectionOperations={
 *          "ref_gpecomp"={
 *              "path"="/admin/referentiels",
 *              "normalization_context"={"groups"={"refgpecomp:read"}},
 *              "method"="GET"
 *          },
 *          "gpecomp_comp"={
 *              "path"="/admin/referentiels/grpecompetences",
 *              "normalization_context"={"groups"={"gpecompcomp:read"}},
 *              "method"="GET"
 *          },
 *          "addReferentiel":{
 *              "route_name"="addReferentiel",
 *              "method"="POST",
 *              "denormalization_context"={"groups"={"addref:write"}},
 *              "path":"/admin/referentiels",
 *              }
 *      },
 *      itemOperations={
 *          "referentiels_gpecompetences_id"={
 *              "path"="/admin/referentiels/{id}",
 *              "normalization_context"={"groups"={"referentiel_gpecompetence:read"}},
 *              "method"="GET"
 *          },
 *         
 * 
 *          "modifierReferentiel"={
 *               "path"="/admin/referentiels/{id}",
 *              "normalization_context"={"groups"={"reff:read"}},
 *              "denormalization_context"={"groups"={"ref:write"}},
 *              "method"="PUT"
 *          },
 * 
 *         "supprimerReferentiel"={
 *          "path"="/admin/referentiels/{id}",
 *          "method"="DELETE"
 *          }
 *      }
 * )
 * @ApiFilter(SearchFilter::class, properties={"status": "exact"})
 */
class Referentiel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"refgpecomp:read","referentiel_gpecompetence:read","gpecompcomp:read"})
     * @Groups({"list_groupe:read","modify_promo:write","list_promo:read","add_promo:write"})
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=CompetencesValides::class, mappedBy="referentiel")
     */
    private $competencesValides;

    /**
     * @ORM\OneToMany(targetEntity=Promo::class, mappedBy="referentiel")
     * @Groups({"ref:write"})
     */
    private $promos;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"refgpecomp:read","ref:write","referentiel_gpecompetence:read","gpecompcomp:read"})
     * @Groups({"list_groupe:read","list_promo:read","addref:write","add_promo:write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"refgpecomp:read","ref:write","referentiel_gpecompetence:read","gpecompcomp:read"})
     * @Groups({"list_groupe:read","list_promo:read","addref:write"})
     */
    private $presentation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"refgpecomp:read","ref:write","referentiel_gpecompetence:read","gpecompcomp:read"})
     * @Groups({"list_groupe:read","list_promo:read","addref:write"})
     */
    private $critereEvaluation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"refgpecomp:read","ref:write","referentiel_gpecompetence:read","gpecompcomp:read"})
     * @Groups({"list_groupe:read","list_promo:read","addref:write"})
     */
    private $critereAdmission;

    /**
     * @ORM\ManyToMany(targetEntity=GroupeCompetence::class, mappedBy="referentiels", cascade={"persist"})
     * @ApiSubresource
     * @Groups({"refgpecomp:read","ref:write","referentiel_gpecompetence:read","gpecompcomp:read","addref:write"})
     */
    private $groupeCompetences;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"addref:write"})
     */
    private $status;

    /**
     * @ORM\Column(type="blob")
     * @Groups({"refgpecomp:read","ref:write","referentiel_gpecompetence:read","gpecompcomp:read"})
     * @Groups({"list_groupe:read","list_promo:read","addref:write"})
     */
    private $programme;

    public function __construct()
    {
        $this->status=true;
        $this->competencesValides = new ArrayCollection();
        $this->promos = new ArrayCollection();
        $this->groupeCompetences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $competencesValide->setReferentiel($this);
        }

        return $this;
    }

    public function removeCompetencesValide(CompetencesValides $competencesValide): self
    {
        if ($this->competencesValides->removeElement($competencesValide)) {
            // set the owning side to null (unless already changed)
            if ($competencesValide->getReferentiel() === $this) {
                $competencesValide->setReferentiel(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Promo[]
     */
    public function getPromos(): Collection
    {
        return $this->promos;
    }

    public function addPromo(Promo $promo): self
    {
        if (!$this->promos->contains($promo)) {
            $this->promos[] = $promo;
            $promo->setReferentiel($this);
        }

        return $this;
    }

    public function removePromo(Promo $promo): self
    {
        if ($this->promos->removeElement($promo)) {
            // set the owning side to null (unless already changed)
            if ($promo->getReferentiel() === $this) {
                $promo->setReferentiel(null);
            }
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

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getCritereEvaluation(): ?string
    {
        return $this->critereEvaluation;
    }

    public function setCritereEvaluation(string $critereEvaluation): self
    {
        $this->critereEvaluation = $critereEvaluation;

        return $this;
    }

    public function getCritereAdmission(): ?string
    {
        return $this->critereAdmission;
    }

    public function setCritereAdmission(string $critereAdmission): self
    {
        $this->critereAdmission = $critereAdmission;

        return $this;
    }

    /**
     * @return Collection|GroupeCompetence[]
     */
    public function getGroupeCompetences(): Collection
    {
        return $this->groupeCompetences;
    }

    public function addGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if (!$this->groupeCompetences->contains($groupeCompetence)) {
            $this->groupeCompetences[] = $groupeCompetence;
            $groupeCompetence->addReferentiel($this);
        }

        return $this;
    }

    public function removeGroupeCompetence(GroupeCompetence $groupeCompetence): self
    {
        if ($this->groupeCompetences->removeElement($groupeCompetence)) {
            $groupeCompetence->removeReferentiel($this);
        }

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

    public function getProgramme(): ?string
    {
        if ($this->programme) {
            $programme_str = stream_get_contents($this->programme);
            return base64_encode($programme_str);
        }
        return null;
    }

    public function setProgramme($programme): self
    {
        $this->programme = $programme;

        return $this;
    }
}

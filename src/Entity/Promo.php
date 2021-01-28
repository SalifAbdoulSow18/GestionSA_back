<?php

namespace App\Entity;

use App\Entity\Chat;
use App\Entity\Groupe;
use App\Entity\Referentiel;
use App\Entity\BriefMaPromo;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\CompetencesValides;
use App\Repository\PromoRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PromoRepository::class)
 * @ApiResource(
 * collectionOperations={
 * "list_promo"={
 *          "method"= "GET",
 *          "path" = "/admin/promos",
 *          "normalization_context"={"groups"={"list_promo:read"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 * "list_promo_principal"={
 *          "method"= "GET",
 *          "path" = "/admin/promos/principal",
 *          "normalization_context"={"groups"={"list_promo_principal:read"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 * "list_promo_attente"={
 *          "method"= "GET",
 *          "path" = "/admin/promos/apprenants/attente",
 *          "normalization_context"={"groups"={"list_promo_attente:read"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 * 
 * "add_promo"={
 *          "method"= "POST",
 *          "path" = "/admin/promos",
 *          "denormalization_context"={"groups"={"add_promo:write"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 * },
 * itemOperations={
 * "list_one_promo_apprenant"={
 *          "method"= "GET",
 *          "path" = "/admin/promos/{id}",
 *          "normalization_context"={"groups"={"list_one_promo_apprenant:read"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 * "modify_promo"={
 *          "method"= "PUT",
 *          "path" = "/admin/promos/{id}",
 *          "denormalization_context"={"groups"={"modify_promo:write"}},
 *          "security" = "(is_granted('ROLE_ADMIN') or is_granted('ROLE_FORMATEUR'))"
 *      },
 * }
 * )
 */
class Promo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"list_groupe:read","list_promo:read","ref:write"})
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Chat::class, mappedBy="promo")
     */
    private $chats;

    /**
     * @ORM\ManyToOne(targetEntity=Referentiel::class, inversedBy="promos")
     * @Groups({"list_groupe:read","modify_promo:write","list_promo:read"})
     * @ApiSubresource
     */
    private $referentiel;

    /**
     * @ORM\OneToMany(targetEntity=CompetencesValides::class, mappedBy="promo")
     */
    private $competencesValides;

    /**
     * @ORM\OneToMany(targetEntity=BriefMaPromo::class, mappedBy="promo")
     */
    private $briefMaPromo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"list_groupe:read","list_promo:read","add_promo:write"})
     */
    private $libelle;

    /**
     * @ORM\Column(type="date")
     * @Groups({"list_groupe:read","list_promo:read","add_promo:write"})
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     * @Groups({"list_groupe:read","list_promo:read","add_promo:write"})
     */
    private $dateFin;

    /**
     * @ORM\Column(type="date")
     * @Groups({"list_groupe:read","list_promo:read","add_promo:write"})
     */
    private $annee;

    /**
     * @ORM\OneToMany(targetEntity=Groupe::class, mappedBy="promos")
     * @Groups({"list_promo:read","add_promo:write"})
     */
    private $groupes;

    /**
     * @ORM\OneToMany(targetEntity=Apprenant::class, mappedBy="promo")
     * @Groups({"list_promo:read","add_promo:write"})
     */
    private $apprenants;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function __construct()
    {
        $this->status=true;
        $this->chats = new ArrayCollection();
        $this->competencesValides = new ArrayCollection();
        $this->briefMaPromo = new ArrayCollection();
        $this->groupes = new ArrayCollection();
        $this->apprenants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Chat[]
     */
    public function getChats(): Collection
    {
        return $this->chats;
    }

    public function addChat(Chat $chat): self
    {
        if (!$this->chats->contains($chat)) {
            $this->chats[] = $chat;
            $chat->setPromo($this);
        }

        return $this;
    }

    public function removeChat(Chat $chat): self
    {
        if ($this->chats->removeElement($chat)) {
            // set the owning side to null (unless already changed)
            if ($chat->getPromo() === $this) {
                $chat->setPromo(null);
            }
        }

        return $this;
    }

    public function getReferentiel(): ?Referentiel
    {
        return $this->referentiel;
    }

    public function setReferentiel(?Referentiel $referentiel): self
    {
        $this->referentiel = $referentiel;

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
            $competencesValide->setPromo($this);
        }

        return $this;
    }

    public function removeCompetencesValide(CompetencesValides $competencesValide): self
    {
        if ($this->competencesValides->removeElement($competencesValide)) {
            // set the owning side to null (unless already changed)
            if ($competencesValide->getPromo() === $this) {
                $competencesValide->setPromo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BriefMaPromo[]
     */
    public function getBriefMaPromo(): Collection
    {
        return $this->briefMaPromo;
    }

    public function addBriefMaPromo(BriefMaPromo $briefMaPromo): self
    {
        if (!$this->briefMaPromo->contains($briefMaPromo)) {
            $this->briefMaPromo[] = $briefMaPromo;
            $briefMaPromo->setPromo($this);
        }

        return $this;
    }

    public function removeBriefMaPromo(BriefMaPromo $briefMaPromo): self
    {
        if ($this->briefMaPromo->removeElement($briefMaPromo)) {
            // set the owning side to null (unless already changed)
            if ($briefMaPromo->getPromo() === $this) {
                $briefMaPromo->setPromo(null);
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): self
    {
        $this->annee = $annee;

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
            $groupe->setPromos($this);
        }

        return $this;
    }

    public function removeGroupe(Groupe $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getPromos() === $this) {
                $groupe->setPromos(null);
            }
        }

        return $this;
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
            $apprenant->setPromo($this);
        }

        return $this;
    }

    public function removeApprenant(Apprenant $apprenant): self
    {
        if ($this->apprenants->removeElement($apprenant)) {
            // set the owning side to null (unless already changed)
            if ($apprenant->getPromo() === $this) {
                $apprenant->setPromo(null);
            }
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
}

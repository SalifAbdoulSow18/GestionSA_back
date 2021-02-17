<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Asset;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"admin"="Admin","apprenant"="Apprenant", "cm"="Cm" , "formateur"="Formateur" ,"user"="User"})
 * @ApiResource(
 * normalizationContext={"groups"={"user:read"}},
 *    attributes={
 *        "security"="is_granted('ROLE_ADMIN') or is_granted('ROLE_CM')",
 *        "security_message"="Vous n'avez pas access à cette Ressource"
 * },
 *    collectionOperations={
 *        "get"={"path"="/admin/users"
 * },
 *        "addUser":{
 *              "route_name"="adding",
 *              "path":"/admin/users",
 *               "access_control"="(is_granted('ROLE_ADMIN') )",
 *               "deserialize" = false
 *              }
 *},
 *    itemOperations={
 *        "get"={"path"="/admin/users/{id}"},
 *        "editUser":{
 *              "route_name"="modification",
 *              "path":"/admin/users/{id}",
 *               "access_control"="(is_granted('ROLE_ADMIN') )",
 *               "deserialize" = false
 *              },
 *         "delete"={"path"="/admin/users/{id}"}
 *}
 * )
 * @ApiFilter(SearchFilter::class, properties={"status": "exact"})
 * @UniqueEntity("username", message="l'adress username doit être unique")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read","apprenant:read","formateur:read"})
     * @Groups({"modify_promo:write","list_one_promo:read","list_groupe:read","profil:read","add_promo:write","list_promo:read","modify_groupe:write","list_groupe_apprenant:read","add_groupe:write"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Asset\Email(message="l'adress email n'est pas valide")
     * @Asset\NotBlank(message="Veuillez remplir ce champs")  
     * @Groups({"modify_promo:write","list_one_promo:read","user:read","profil:read","apprenant:read","formateur:read"})
     *     
     */
    private $email;

    
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Asset\NotBlank(message="Veuillez remplir ce champs")
     * @Groups({"user:read","apprenant:read","formateur:read"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Asset\NotBlank(message="Veuillez remplir ce champs")
     * @Groups({"user:read","apprenant:read","formateur:read"})
     */
    private $username;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @Asset\NotBlank(message="Veuillez remplir ce champs")
     * @Groups({"user:read","apprenant:read","formateur:read"})
     */
    private $profil;

    /**
     * @ORM\Column(type="string", length=255)
     * @Asset\NotBlank(message="Veuillez remplir ce champs")
     * @Groups({"user:read","apprenant:read","formateur:read"})
     * @Groups({"list_one_promo:read","list_groupe:read","profil:read","list_promo:read","list_groupe_apprenant:read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Asset\NotBlank(message="Veuillez remplir ce champs")
     * @Groups({"user:read","apprenant:read","formateur:read"})
     * @Groups({"list_one_promo:read","list_groupe:read","profil:read","list_promo:read","list_groupe_apprenant:read"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Asset\NotBlank(message="Veuillez remplir ce champs")
     * @Groups({"user:read","apprenant:read","formateur:read"})
     * @Groups({"list_one_promo:read","list_groupe:read","profil:read","list_promo:read","list_groupe_apprenant:read"})
     */
    private $phone;

    /**
     * @ORM\OneToMany(targetEntity=Chat::class, mappedBy="users")
     */
    private $chats;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Groups({"user:read","profil:read","apprenant:read","formateur:read"})
     */
    private $photo;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user:read"})
     */
    private $status;

    public function __construct()
    {
        $this->status=true;
        $this->chats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }



    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
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
            $chat->setUsers($this);
        }

        return $this;
    }

    public function removeChat(Chat $chat): self
    {
        if ($this->chats->removeElement($chat)) {
            // set the owning side to null (unless already changed)
            if ($chat->getUsers() === $this) {
                $chat->setUsers(null);
            }
        }

        return $this;
    }

    public function getPhoto()
    {
        if ($this->photo !== null) {
            return base64_encode(stream_get_contents($this->photo));
        }else{
            return $this->photo;
        }
        
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;

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

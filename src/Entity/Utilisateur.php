<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\UtilisateurRepository;
use App\State\UserPasswordHasher;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'cet utilisateur existe déjà')]
#[ApiResource(
    operations: [
        new GetCollection(normalizationContext: ['groups' => ['user:collection']]),
        new Post(processor: UserPasswordHasher::class, validationContext: ['groups' => ['Default', 'user:create']]),
        new Get(),
        new Put(processor: UserPasswordHasher::class, validationContext: ['groups' => ['Default', 'user:create']]),
        new Patch(processor: UserPasswordHasher::class),
        new Delete(),
    ],
)]
class Utilisateur implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[Groups(['user:collection'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['user:create', 'user:collection'])]
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $mdp = null;

    #[Groups(['user:create'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $plain_password = null;

    #[Groups(['user:collection'])]
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[Groups(['user:collection'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[Groups(['user:collection'])]
    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[Groups(['user:collection'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $whatsapp = null;

    #[Groups(['user:collection'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[Groups(['user:collection'])]
    #[ORM\OneToOne(mappedBy: 'utilisateur', cascade: ['persist', 'remove'])]
    private ?AbonnementUtilisateur $abonnementUtilisateur = null;

    #[Groups(['user:collection'])]
    #[ORM\ManyToMany(targetEntity: Ville::class, inversedBy: 'utilisateurs')]
    private Collection $ville;

    public function __construct()
    {
        $this->ville = new ArrayCollection();
    }

    public function getUserIdentifier(): string
    {
        return $this->getTelephone();
    }

    public function eraseCredentials()
    {
        $this->setPlainPassword(NULL);
    }

    public function getRoles(): array
    {
        return [];
    }

    public function getPassword(): ?string
    {
        return $this->mdp;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plain_password;
    }

    public function setPlainPassword(?string $plain_password): static
    {
        $this->plain_password = $plain_password;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getWhatsapp(): ?string
    {
        return $this->whatsapp;
    }

    public function setWhatsapp(?string $whatsapp): static
    {
        $this->whatsapp = $whatsapp;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getAbonnementUtilisateur(): ?AbonnementUtilisateur
    {
        return $this->abonnementUtilisateur;
    }

    public function setAbonnementUtilisateur(AbonnementUtilisateur $abonnementUtilisateur): static
    {
        // set the owning side of the relation if necessary
        if ($abonnementUtilisateur->getUtilisateur() !== $this) {
            $abonnementUtilisateur->setUtilisateur($this);
        }

        $this->abonnementUtilisateur = $abonnementUtilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Ville>
     */
    public function getVille(): Collection
    {
        return $this->ville;
    }

    public function addVille(Ville $ville): static
    {
        if (!$this->ville->contains($ville)) {
            $this->ville->add($ville);
        }

        return $this;
    }

    public function removeVille(Ville $ville): static
    {
        $this->ville->removeElement($ville);

        return $this;
    }
}

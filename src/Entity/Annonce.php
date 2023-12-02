<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
#[ApiResource(operations: [
    new GetCollection(normalizationContext: ['groups' => ['annonce:collection', 'user:collection', 'ville:collection', 'typeVehicule:collection', 'annoncePhoto:collection']]),
    new Post(),
    new Get(),
    new Put(),
    new Patch(),
    new Delete(),
],)]
class Annonce
{
    #[Groups(['annonce:collection'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['annonce:collection'])]
    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[Groups(['annonce:collection'])]
    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[Groups(['annonce:collection'])]
    #[ORM\ManyToOne(inversedBy: 'annonces')]
    private ?TypeVehicule $typeVehicule = null;

    #[Groups(['annonce:collection'])]
    #[ORM\ManyToOne(inversedBy: 'annonces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ville $ville = null;

    #[Groups(['annonce:collection'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comune = null;

    #[Groups(['annonce:collection'])]
    #[ORM\Column]
    private ?int $nbPlaces = null;

    #[Groups(['annonce:collection'])]
    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[Groups(['annonce:collection'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $whatsapp = null;

    #[Groups(['annonce:collection'])]
    #[ORM\Column]
    private ?bool $avecChauffeur = null;

    #[Groups(['annonce:collection'])]
    #[ORM\Column]
    private ?bool $chauffeurObligatoire = null;

    #[Groups(['annonce:collection'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[Groups(['annonce:collection'])]
    #[ORM\OneToMany(mappedBy: 'annonce', targetEntity: AnnoncePhoto::class)]
    private Collection $annoncePhotos;

    #[Groups(['annonce:collection'])]
    #[ORM\OneToOne(mappedBy: 'annonce', cascade: ['persist', 'remove'])]
    private ?BoostAnnonce $boostAnnonce = null;

    #[Groups(['annonce:collection'])]
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Utilisateur $utilisateur = null;

    public function __construct()
    {
        $this->annoncePhotos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getTypeVehicule(): ?TypeVehicule
    {
        return $this->typeVehicule;
    }

    public function setTypeVehicule(?TypeVehicule $typeVehicule): static
    {
        $this->typeVehicule = $typeVehicule;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getComune(): ?string
    {
        return $this->comune;
    }

    public function setComune(?string $comune): static
    {
        $this->comune = $comune;

        return $this;
    }

    public function getNbPlaces(): ?int
    {
        return $this->nbPlaces;
    }

    public function setNbPlaces(int $nbPlaces): static
    {
        $this->nbPlaces = $nbPlaces;

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

    public function isAvecChauffeur(): ?bool
    {
        return $this->avecChauffeur;
    }

    public function setAvecChauffeur(bool $avecChauffeur): static
    {
        $this->avecChauffeur = $avecChauffeur;

        return $this;
    }

    public function isChauffeurObligatoire(): ?bool
    {
        return $this->chauffeurObligatoire;
    }

    public function setChauffeurObligatoire(bool $chauffeurObligatoire): static
    {
        $this->chauffeurObligatoire = $chauffeurObligatoire;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, AnnoncePhoto>
     */
    public function getAnnoncePhotos(): Collection
    {
        return $this->annoncePhotos;
    }

    public function addAnnoncePhoto(AnnoncePhoto $annoncePhoto): static
    {
        if (!$this->annoncePhotos->contains($annoncePhoto)) {
            $this->annoncePhotos->add($annoncePhoto);
            $annoncePhoto->setAnnonce($this);
        }

        return $this;
    }

    public function removeAnnoncePhoto(AnnoncePhoto $annoncePhoto): static
    {
        if ($this->annoncePhotos->removeElement($annoncePhoto)) {
            // set the owning side to null (unless already changed)
            if ($annoncePhoto->getAnnonce() === $this) {
                $annoncePhoto->setAnnonce(null);
            }
        }

        return $this;
    }

    public function getBoostAnnonce(): ?BoostAnnonce
    {
        return $this->boostAnnonce;
    }

    public function setBoostAnnonce(BoostAnnonce $boostAnnonce): static
    {
        // set the owning side of the relation if necessary
        if ($boostAnnonce->getAnnonce() !== $this) {
            $boostAnnonce->setAnnonce($this);
        }

        $this->boostAnnonce = $boostAnnonce;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): static
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}

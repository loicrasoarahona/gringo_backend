<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BoostAnnonceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BoostAnnonceRepository::class)]
#[ApiResource]
class BoostAnnonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'boostAnnonce', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Annonce $annonce = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $expiration = null;

    #[ORM\ManyToOne(inversedBy: 'boostAnnonces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PlanBoost $planBoost = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnnonce(): ?Annonce
    {
        return $this->annonce;
    }

    public function setAnnonce(Annonce $annonce): static
    {
        $this->annonce = $annonce;

        return $this;
    }

    public function getExpiration(): ?\DateTimeInterface
    {
        return $this->expiration;
    }

    public function setExpiration(\DateTimeInterface $expiration): static
    {
        $this->expiration = $expiration;

        return $this;
    }

    public function getPlanBoost(): ?PlanBoost
    {
        return $this->planBoost;
    }

    public function setPlanBoost(?PlanBoost $planBoost): static
    {
        $this->planBoost = $planBoost;

        return $this;
    }
}

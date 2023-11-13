<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PlanBoostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanBoostRepository::class)]
#[ApiResource]
class PlanBoost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?float $prix = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\OneToMany(mappedBy: 'planBoost', targetEntity: BoostAnnonce::class)]
    private Collection $boostAnnonces;

    public function __construct()
    {
        $this->boostAnnonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Collection<int, BoostAnnonce>
     */
    public function getBoostAnnonces(): Collection
    {
        return $this->boostAnnonces;
    }

    public function addBoostAnnonce(BoostAnnonce $boostAnnonce): static
    {
        if (!$this->boostAnnonces->contains($boostAnnonce)) {
            $this->boostAnnonces->add($boostAnnonce);
            $boostAnnonce->setPlanBoost($this);
        }

        return $this;
    }

    public function removeBoostAnnonce(BoostAnnonce $boostAnnonce): static
    {
        if ($this->boostAnnonces->removeElement($boostAnnonce)) {
            // set the owning side to null (unless already changed)
            if ($boostAnnonce->getPlanBoost() === $this) {
                $boostAnnonce->setPlanBoost(null);
            }
        }

        return $this;
    }
}

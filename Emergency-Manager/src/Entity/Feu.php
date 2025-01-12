<?php

namespace App\Entity;

use App\Repository\FeuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeuRepository::class)]
class Feu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coorX = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coorY = null;

    #[ORM\Column(nullable: true)]
    private ?int $intensite = null;

    /**
     * @var Collection<int, Intervention>
     */
    #[ORM\OneToMany(targetEntity: Intervention::class, mappedBy: 'feu')]
    private Collection $interventions;

    #[ORM\Column(nullable: true)]
    private ?bool $status = true;

    public function __construct()
    {
        $this->interventions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCoorX(): ?string
    {
        return $this->coorX;
    }

    public function setCoorX(?string $coorX): static
    {
        $this->coorX = $coorX;

        return $this;
    }

    public function getCoorY(): ?string
    {
        return $this->coorY;
    }

    public function setCoorY(?string $coorY): static
    {
        $this->coorY = $coorY;

        return $this;
    }

    public function getIntensite(): ?int
    {
        return $this->intensite;
    }

    public function setIntensite(?int $intensite): static
    {
        $this->intensite = $intensite;

        return $this;
    }

    /**
     * @return Collection<int, Intervention>
     */
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

    public function addIntervention(Intervention $intervention): static
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions->add($intervention);
            $intervention->setFeu($this);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): static
    {
        if ($this->interventions->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getFeu() === $this) {
                $intervention->setFeu(null);
            }
        }

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(?bool $status): static
    {
        $this->status = $status;

        return $this;
    }
}

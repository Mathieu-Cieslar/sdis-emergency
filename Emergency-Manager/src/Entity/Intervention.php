<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InterventionRepository::class)]
class Intervention
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?Feu $feu = null;

    /**
     * @var Collection<int, Camion>
     */
    #[ORM\ManyToMany(targetEntity: Camion::class, mappedBy: 'intervention')]
    private Collection $camions;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    private ?Caserne $caserne = null;

    public function __construct()
    {
        $this->camions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFeu(): ?Feu
    {
        return $this->feu;
    }

    public function setFeu(?Feu $feu): static
    {
        $this->feu = $feu;

        return $this;
    }

    /**
     * @return Collection<int, Camion>
     */
    public function getCamions(): Collection
    {
        return $this->camions;
    }

    public function addCamion(Camion $camion): static
    {
        if (!$this->camions->contains($camion)) {
            $this->camions->add($camion);
            $camion->addIntervention($this);
        }

        return $this;
    }

    public function removeCamion(Camion $camion): static
    {
        if ($this->camions->removeElement($camion)) {
            $camion->removeIntervention($this);
        }

        return $this;
    }

    public function getCaserne(): ?Caserne
    {
        return $this->caserne;
    }

    public function setCaserne(?Caserne $caserne): static
    {
        $this->caserne = $caserne;

        return $this;
    }
}

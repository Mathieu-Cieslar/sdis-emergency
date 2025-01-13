<?php

namespace App\Entity;

use App\Repository\InterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Ignore;

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
//    #[ORM\ManyToMany(targetEntity: Camion::class, mappedBy: 'intervention')]
//    #[Ignore]
//    private Collection $camions;

    #[ORM\ManyToOne(inversedBy: 'interventions')]
    #[Ignore]
    private ?Caserne $caserne = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $trajet = null;

    #[ORM\Column(nullable: true)]
    private ?int $tempsTrajet = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateIntervention = null;

    #[ORM\ManyToOne(inversedBy: 'inyervention')]
    #[Ignore]
    private ?Camion $camion = null;

    public function __construct()
    {
//        $this->camions = new ArrayCollection();
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

//    /**
//     * @return Collection<int, Camion>
//     */
//    public function getCamions(): Collection
//    {
//        return $this->camions;
//    }

//    public function addCamion(Camion $camion): static
//    {
//        if (!$this->camions->contains($camion)) {
//            $this->camions->add($camion);
//            $camion->addIntervention($this);
//        }
//
//        return $this;
//    }
//
//    public function removeCamion(Camion $camion): static
//    {
//        if ($this->camions->removeElement($camion)) {
//            $camion->removeIntervention($this);
//        }
//
//        return $this;
//    }

    public function getCaserne(): ?Caserne
    {
        return $this->caserne;
    }

    public function setCaserne(?Caserne $caserne): static
    {
        $this->caserne = $caserne;

        return $this;
    }

    public function getTrajet(): ?array
    {
        return $this->trajet;
    }

    public function setTrajet(?array $trajet): static
    {
        $this->trajet = $trajet;

        return $this;
    }

    public function getTempsTrajet(): ?int
    {
        return $this->tempsTrajet;
    }

    public function setTempsTrajet(?int $tempsTrajet): static
    {
        $this->tempsTrajet = $tempsTrajet;

        return $this;
    }

    public function getDateIntervention(): ?\DateTimeInterface
    {
        return $this->dateIntervention;
    }

    public function setDateIntervention(?\DateTimeInterface $dateIntervention): static
    {
        $this->dateIntervention = $dateIntervention;

        return $this;
    }

    public function getCamion(): ?Camion
    {
        return $this->camion;
    }

    public function setCamion(?Camion $camion): static
    {
        $this->camion = $camion;

        return $this;
    }
}

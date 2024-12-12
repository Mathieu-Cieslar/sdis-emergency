<?php

namespace App\Entity;

use App\Repository\CaserneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CaserneRepository::class)]
class Caserne
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
    private ?int $nbCamion = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbPompier = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

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

    public function getNbCamion(): ?int
    {
        return $this->nbCamion;
    }

    public function setNbCamion(?int $nbCamion): static
    {
        $this->nbCamion = $nbCamion;

        return $this;
    }

    public function getNbPompier(): ?int
    {
        return $this->nbPompier;
    }

    public function setNbPompier(?int $nbPompier): static
    {
        $this->nbPompier = $nbPompier;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
}

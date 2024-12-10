<?php

namespace App\Entity;

use App\Repository\CapteurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CapteurRepository::class)]
class Capteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $intensite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typeCapteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coorX = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coorY = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTypeCapteur(): ?string
    {
        return $this->typeCapteur;
    }

    public function setTypeCapteur(?string $typeCapteur): static
    {
        $this->typeCapteur = $typeCapteur;

        return $this;
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
}

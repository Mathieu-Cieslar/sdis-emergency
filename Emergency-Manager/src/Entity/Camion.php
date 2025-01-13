<?php

namespace App\Entity;

use App\Repository\CamionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Ignore;

#[ORM\Entity(repositoryClass: CamionRepository::class)]
class Camion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbPompier = null;

    /**
     * @var Collection<int, Intervention>
     */
//    #[ORM\ManyToMany(targetEntity: Intervention::class, inversedBy: 'camions')]
//    private Collection $intervention;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coorX = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coorY = null;

    #[ORM\ManyToOne(inversedBy: 'camions')]
    private ?Caserne $caserne = null;

    /**
     * @var Collection<int, Intervention>
     */
    #[ORM\OneToMany(targetEntity: Intervention::class, mappedBy: 'camion')]
    #[Ignore]
    private Collection $intervention;

    public function __construct()
    {
//        $this->intervention = new ArrayCollection();
        $this->intervention = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Intervention>
     */
    public function getIntervention(): Collection
    {
        return $this->intervention;
    }

    public function addIntervention(Intervention $intervention): static
    {
        if (!$this->intervention->contains($intervention)) {
            $this->intervention->add($intervention);
        }

        return $this;
    }

    public function removeIntervention(Intervention $intervention): static
    {
        $this->intervention->removeElement($intervention);

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

    public function getCaserne(): ?Caserne
    {
        return $this->caserne;
    }

    public function setCaserne(?Caserne $caserne): static
    {
        $this->caserne = $caserne;

        return $this;
    }

//    /**
//     * @return Collection<int, Intervention>
//     */
//    public function getInyervention(): Collection
//    {
//        return $this->inyervention;
//    }
//
//    public function addInyervention(Intervention $inyervention): static
//    {
//        if (!$this->inyervention->contains($inyervention)) {
//            $this->inyervention->add($inyervention);
//            $inyervention->setCamion($this);
//        }
//
//        return $this;
//    }
//
//    public function removeInyervention(Intervention $inyervention): static
//    {
//        if ($this->inyervention->removeElement($inyervention)) {
//            // set the owning side to null (unless already changed)
//            if ($inyervention->getCamion() === $this) {
//                $inyervention->setCamion(null);
//            }
//        }
//
//        return $this;
//    }
}

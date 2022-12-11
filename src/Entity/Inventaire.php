<?php

namespace App\Entity;

use App\Repository\InventaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InventaireRepository::class)
 */
class Inventaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @ORM\OneToMany(targetEntity=UniteBien::class, mappedBy="DernierInventaire")
     */
    private $uniteBiens;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

    public function __construct()
    {
        $this->uniteBiens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection|UniteBien[]
     */
    public function getUniteBiens(): Collection
    {
        return $this->uniteBiens;
    }

    public function addUniteBien(UniteBien $uniteBien): self
    {
        if (!$this->uniteBiens->contains($uniteBien)) {
            $this->uniteBiens[] = $uniteBien;
            $uniteBien->setDernierInventaire($this);
        }

        return $this;
    }

    public function removeUniteBien(UniteBien $uniteBien): self
    {
        if ($this->uniteBiens->removeElement($uniteBien)) {
            // set the owning side to null (unless already changed)
            if ($uniteBien->getDernierInventaire() === $this) {
                $uniteBien->setDernierInventaire(null);
            }
        }

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): self
    {
        $this->year = $year;

        return $this;
    }
}

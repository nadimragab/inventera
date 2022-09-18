<?php

namespace App\Entity;

use App\Repository\UniteBienRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UniteBienRepository::class)
 */
class UniteBien
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Bien::class, inversedBy="uniteBiens")
     */
    private $refBien;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbrInv;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $etatPhy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numUnite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefBien(): ?Bien
    {
        return $this->refBien;
    }

    public function setRefBien(?Bien $refBien): self
    {
        $this->refBien = $refBien;

        return $this;
    }

    public function getNbrInv(): ?int
    {
        return $this->nbrInv;
    }

    public function setNbrInv(?int $nbrInv): self
    {
        $this->nbrInv = $nbrInv;

        return $this;
    }

    public function getEtatPhy(): ?string
    {
        return $this->etatPhy;
    }

    public function setEtatPhy(?string $etatPhy): self
    {
        $this->etatPhy = $etatPhy;

        return $this;
    }

    public function getNumUnite(): ?int
    {
        return $this->numUnite;
    }

    public function setNumUnite(?int $numUnite): self
    {
        $this->numUnite = $numUnite;

        return $this;
    }
}

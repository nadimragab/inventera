<?php

namespace App\Entity;

use App\Repository\UniteBienRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\Groups;
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
     * @Groups({"api"})
     */
    private $nbrInv;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Groups({"api"})
     */
    private $etatPhy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numUnite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"api"})
     */
    private $refUnite;

    /**
     * @ORM\ManyToOne(targetEntity=Structure::class, inversedBy="serviceAtt")
     * @Groups({"api"})
     */
    private $structureAtt;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="uniteBiens")
     * @Groups({"api"})
     */
    private $serviceAtt;

    /**
     * @ORM\ManyToOne(targetEntity=Inventaire::class)
     */
    private $premierInventaire;

    /**
     * @ORM\ManyToOne(targetEntity=Inventaire::class, inversedBy="uniteBiens")
     */
    private $DernierInventaire;

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

    public function getRefUnite(): ?string
    {
        return $this->refUnite;
    }

    public function setRefUnite(?string $refUnite): self
    {
        $this->refUnite = $refUnite;

        return $this;
    }

    public function getStructureAtt(): ?Structure
    {
        return $this->structureAtt;
    }

    public function setStructureAtt(?Structure $structureAtt): self
    {
        $this->structureAtt = $structureAtt;

        return $this;
    }

    public function getServiceAtt(): ?Service
    {
        return $this->serviceAtt;
    }

    public function setServiceAtt(?Service $serviceAtt): self
    {
        $this->serviceAtt = $serviceAtt;

        return $this;
    }

    public function getPremierInventaire(): ?Inventaire
    {
        return $this->premierInventaire;
    }

    public function setPremierInventaire(?Inventaire $premierInventaire): self
    {
        $this->premierInventaire = $premierInventaire;

        return $this;
    }

    public function getDernierInventaire(): ?Inventaire
    {
        return $this->DernierInventaire;
    }

    public function setDernierInventaire(?Inventaire $DernierInventaire): self
    {
        $this->DernierInventaire = $DernierInventaire;

        return $this;
    }

}

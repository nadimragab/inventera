<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BienRepository;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=BienRepository::class)
 * @Vich\Uploadable
 */
class Bien
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referenceBien;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAcquisition;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreUniteLot;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="biens")
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $image;

    public function __toString(): string
    {
     return $this->nom;   
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getReferenceBien(): ?string
    {
        return $this->referenceBien;
    }

    public function setReferenceBien(string $referenceBien): self
    {
        $this->referenceBien = $referenceBien;

        return $this;
    }



    public function getDateAcquisition(): ?\DateTimeInterface
    {
        return $this->dateAcquisition;
    }

    public function setDateAcquisition(\DateTimeInterface $dateAcquisition): self
    {
        $this->dateAcquisition = $dateAcquisition;

        return $this;
    }

    public function getNombreUniteLot(): ?int
    {
        return $this->nombreUniteLot;
    }

    public function setNombreUniteLot(int $nombreUniteLot): self
    {
        $this->nombreUniteLot = $nombreUniteLot;

        return $this;
    }

    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): self
    {
        $this->service = $service;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }


}

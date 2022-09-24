<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StructureRepository::class)
 */
class Structure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"api"})
     */
    private $nomStructure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"api"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Service::class, mappedBy="structure")
     */
    private $services;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referenceStructure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Bien::class, mappedBy="structure")
     */
    private $yes;

    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->yes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNomStructure();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomStructure(): ?string
    {
        return $this->nomStructure;
    }

    public function setNomStructure(string $nomStructure): self
    {
        $this->nomStructure = $nomStructure;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): self
    {
        if (!$this->services->contains($service)) {
            $this->services[] = $service;
            $service->setStructure($this);
        }

        return $this;
    }

    public function removeService(Service $service): self
    {
        if ($this->services->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getStructure() === $this) {
                $service->setStructure(null);
            }
        }

        return $this;
    }

    public function getReferenceStructure(): ?string
    {
        return $this->referenceStructure;
    }

    public function setReferenceStructure(string $referenceStructure): self
    {
        $this->referenceStructure = $referenceStructure;

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

    /**
     * @return Collection<int, Bien>
     */
    public function getYes(): Collection
    {
        return $this->yes;
    }

    public function addYe(Bien $ye): self
    {
        if (!$this->yes->contains($ye)) {
            $this->yes[] = $ye;
            $ye->setStructure($this);
        }

        return $this;
    }

    public function removeYe(Bien $ye): self
    {
        if ($this->yes->removeElement($ye)) {
            // set the owning side to null (unless already changed)
            if ($ye->getStructure() === $this) {
                $ye->setStructure(null);
            }
        }

        return $this;
    }
}

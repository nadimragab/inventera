<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ServiceRepository::class)
 */
class Service
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
    private $nomService;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;


    /**
     * @ORM\ManyToOne(targetEntity=Structure::class, inversedBy="services")
     * @ORM\JoinColumn(nullable=false)
     */
    private $structure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referenceService;

    /**
     * @ORM\OneToMany(targetEntity=Bien::class, mappedBy="service")
     */
    private $biens;

    /**
     * @ORM\OneToMany(targetEntity=UniteBien::class, mappedBy="serviceAtt")
     */
    private $uniteBiens;

    public function __construct()
    {
        $this->biens = new ArrayCollection();
        $this->uniteBiens = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getNomService();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomService(): ?string
    {
        return $this->nomService;
    }

    public function setNomService(string $nomService): self
    {
        $this->nomService = $nomService;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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



    public function getStructure(): ?Structure
    {
        return $this->structure;
    }

    public function setStructure(?Structure $structure): self
    {
        $this->structure = $structure;

        return $this;
    }

    public function getReferenceService(): ?string
    {
        return $this->referenceService;
    }

    public function setReferenceService(string $referenceService): self
    {
        $this->referenceService = $referenceService;

        return $this;
    }

    /**
     * @return Collection<int, Bien>
     */
    public function getBiens(): Collection
    {
        return $this->biens;
    }

    public function addBien(Bien $bien): self
    {
        if (!$this->biens->contains($bien)) {
            $this->biens[] = $bien;
            $bien->setService($this);
        }

        return $this;
    }

    public function removeBien(Bien $bien): self
    {
        if ($this->biens->removeElement($bien)) {
            // set the owning side to null (unless already changed)
            if ($bien->getService() === $this) {
                $bien->setService(null);
            }
        }

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
            $uniteBien->setServiceAtt($this);
        }

        return $this;
    }

    public function removeUniteBien(UniteBien $uniteBien): self
    {
        if ($this->uniteBiens->removeElement($uniteBien)) {
            // set the owning side to null (unless already changed)
            if ($uniteBien->getServiceAtt() === $this) {
                $uniteBien->setServiceAtt(null);
            }
        }

        return $this;
    }
}

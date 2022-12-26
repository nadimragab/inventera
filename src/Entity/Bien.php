<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BienRepository;
use DateTime;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=BienRepository::class)
 * @Vich\Uploadable
 */
class Bien
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"api"})
     */
    private $referenceBien;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateAcquisition;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreUniteLot;

    /**
     * @ORM\ManyToOne(targetEntity=Service::class, inversedBy="biens")
     */
    private $service;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $compteActif;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $compteAmortissement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $compteDotation;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $affectation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $invNature;

    /**
     * @ORM\ManyToOne(targetEntity=Structure::class, inversedBy="yes")
     */
    private $structure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $codeInvNat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelleInvNat;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $valeurAcquisition;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $valeurAmortissement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureeAmortissement;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $etatAmortissement;

    /**
     * @ORM\OneToMany(targetEntity=UniteBien::class, mappedBy="refBien")
     */
    private $uniteBiens;

    public function __construct()
    {
        $this->uniteBiens = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->nom;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?string
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

    public function getCompteActif(): ?int
    {
        return $this->compteActif;
    }

    public function setCompteActif(?int $compteActif): self
    {
        $this->compteActif = $compteActif;

        return $this;
    }

    public function getCompteAmortissement(): ?int
    {
        return $this->compteAmortissement;
    }

    public function setCompteAmortissement(?int $compteAmortissement): self
    {
        $this->compteAmortissement = $compteAmortissement;

        return $this;
    }

    public function getCompteDotation(): ?int
    {
        return $this->compteDotation;
    }

    public function setCompteDotation(?int $compteDotation): self
    {
        $this->compteDotation = $compteDotation;

        return $this;
    }

    public function getAffectation(): ?int
    {
        return $this->affectation;
    }

    public function setAffectation(?int $affectation): self
    {
        $this->affectation = $affectation;

        return $this;
    }

    public function getInvNature(): ?string
    {
        return $this->invNature;
    }

    public function setInvNature(?string $invNature): self
    {
        $this->invNature = $invNature;

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

    public function getCodeInvNat(): ?string
    {
        return $this->codeInvNat;
    }

    public function setCodeInvNat(?string $codeInvNat): self
    {
        $this->codeInvNat = $codeInvNat;

        return $this;
    }

    public function getLibelleInvNat(): ?string
    {
        return $this->libelleInvNat;
    }

    public function setLibelleInvNat(?string $libelleInvNat): self
    {
        $this->libelleInvNat = $libelleInvNat;

        return $this;
    }

    public function getValeurAcquisition(): ?int
    {
        return $this->valeurAcquisition;
    }

    public function setValeurAcquisition(?int $valeurAcquisition): self
    {
        $this->valeurAcquisition = $valeurAcquisition;

        return $this;
    }

    public function getValeurAmortissement(): ?int
    {
        return $this->valeurAmortissement;
    }

    public function setValeurAmortissement(): self
    {
        $this->valeurAmortissement = ($this->valeurAcquisition) / ($this->dureeAmortissement);

        return $this;
    }

    public function getDureeAmortissement(): ?int
    {
        return $this->dureeAmortissement;
    }

    public function setDureeAmortissement(?int $dureeAmortissement): self
    {
        $this->dureeAmortissement = $dureeAmortissement;

        return $this;
    }

    public function getEtatAmortissement(): ?float
    {
        return $this->etatAmortissement;
    }

    public function setEtatAmortissement(): self
    {
        $actuel = new DateTime('now');
        $duree_amortissement = $this->getDateAcquisition()->diff($actuel);
        $this->etatAmortissement = $this->getValeurAmortissement() * intval($duree_amortissement->y);

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
            $uniteBien->setRefBien($this);
        }

        return $this;
    }

    public function removeUniteBien(UniteBien $uniteBien): self
    {
        if ($this->uniteBiens->removeElement($uniteBien)) {
            // set the owning side to null (unless already changed)
            if ($uniteBien->getRefBien() === $this) {
                $uniteBien->setRefBien(null);
            }
        }

        return $this;
    }
}

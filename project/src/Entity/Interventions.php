<?php

namespace App\Entity;

use App\Repository\InterventionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InterventionsRepository::class)
 */
class Interventions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $diagnostique;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Observation;

    /**
     * @ORM\ManyToOne(targetEntity=Ordinateurs::class, inversedBy="interventions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ordinateur;

    /**
     * @ORM\ManyToMany(targetEntity=Techniciens::class, inversedBy="interventions")
     */
    private $techniciens;

    /**
     * @ORM\ManyToMany(targetEntity=Pannes::class, mappedBy="interventions")
     */
    private $pannes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        $this->techniciens = new ArrayCollection();
        $this->pannes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiagnostique(): ?string
    {
        return $this->diagnostique;
    }

    public function setDiagnostique(string $diagnostique): self
    {
        $this->diagnostique = $diagnostique;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->Observation;
    }

    public function setObservation(?string $Observation): self
    {
        $this->Observation = $Observation;

        return $this;
    }

    public function getOrdinateur(): ?Ordinateurs
    {
        return $this->ordinateur;
    }

    public function setOrdinateur(?Ordinateurs $ordinateur): self
    {
        $this->ordinateur = $ordinateur;

        return $this;
    }

    /**
     * @return Collection|Techniciens[]
     */
    public function getTechniciens(): Collection
    {
        return $this->techniciens;
    }

    public function addTechnicien(Techniciens $technicien): self
    {
        if (!$this->techniciens->contains($technicien)) {
            $this->techniciens[] = $technicien;
        }

        return $this;
    }

    public function removeTechnicien(Techniciens $technicien): self
    {
        $this->techniciens->removeElement($technicien);

        return $this;
    }

    /**
     * @return Collection|Pannes[]
     */
    public function getPannes(): Collection
    {
        return $this->pannes;
    }

    public function addPanne(Pannes $panne): self
    {
        if (!$this->pannes->contains($panne)) {
            $this->pannes[] = $panne;
            $panne->addIntervention($this);
        }

        return $this;
    }

    public function removePanne(Pannes $panne): self
    {
        if ($this->pannes->removeElement($panne)) {
            $panne->removeIntervention($this);
        }

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function __toString()
    {
        return "Intervention - " . $this->getId() . " du " . date_format($this->getCreatedAt(), "d/m/Y H:i");
    }
}

<?php

namespace App\Entity;

use App\Repository\SolutionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SolutionsRepository::class)
 */
class Solutions
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
    private $libelle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Pannes::class, mappedBy="solutions")
     */
    private $pannes;

    public function __construct()
    {
        $this->pannes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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
            $panne->addSolution($this);
        }

        return $this;
    }

    public function removePanne(Pannes $panne): self
    {
        if ($this->pannes->removeElement($panne)) {
            $panne->removeSolution($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }
}

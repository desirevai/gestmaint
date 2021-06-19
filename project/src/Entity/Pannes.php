<?php

namespace App\Entity;

use App\Repository\PannesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PannesRepository::class)
 */
class Pannes
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
     * @ORM\ManyToMany(targetEntity=Interventions::class, inversedBy="pannes")
     */
    private $interventions;

    /**
     * @ORM\ManyToMany(targetEntity=Solutions::class, inversedBy="pannes")
     */
    private $solutions;

    public function __construct()
    {
        $this->interventions = new ArrayCollection();
        $this->solutions = new ArrayCollection();
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
     * @return Collection|Interventions[]
     */
    public function getInterventions(): Collection
    {
        return $this->interventions;
    }

    public function addIntervention(Interventions $intervention): self
    {
        if (!$this->interventions->contains($intervention)) {
            $this->interventions[] = $intervention;
        }

        return $this;
    }

    public function removeIntervention(Interventions $intervention): self
    {
        $this->interventions->removeElement($intervention);

        return $this;
    }

    /**
     * @return Collection|Solutions[]
     */
    public function getSolutions(): Collection
    {
        return $this->solutions;
    }

    public function addSolution(Solutions $solution): self
    {
        if (!$this->solutions->contains($solution)) {
            $this->solutions[] = $solution;
        }

        return $this;
    }

    public function removeSolution(Solutions $solution): self
    {
        $this->solutions->removeElement($solution);

        return $this;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }
}

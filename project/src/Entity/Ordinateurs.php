<?php

namespace App\Entity;

use App\Repository\OrdinateursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdinateursRepository::class)
 */
class Ordinateurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $processeur;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $frequence;

    /**
     * @ORM\Column(type="float")
     */
    private $ram;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $typeRam = [];

    /**
     * @ORM\Column(type="integer")
     */
    private $disque;

    /**
     * @ORM\ManyToOne(targetEntity=Agents::class, inversedBy="ordinateurs")
     * @ORM\JoinColumn(nullable=true)
     */
    private $agent;

    /**
     * @ORM\OneToMany(targetEntity=Interventions::class, mappedBy="ordinateur")
     */
    private $interventions;

    /**
     * @ORM\ManyToOne(targetEntity=TypeOrdinateur::class, inversedBy="ordinateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=Fiche::class, mappedBy="ordinateurs")
     */
    private $fiches;

    public function __construct()
    {
        $this->interventions = new ArrayCollection();
        $this->fiches = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getProcesseur(): ?string
    {
        return $this->processeur;
    }

    public function setProcesseur(string $processeur): self
    {
        $this->processeur = $processeur;

        return $this;
    }

    public function getFrequence(): ?float
    {
        return $this->frequence;
    }

    public function setFrequence(?float $frequence): self
    {
        $this->frequence = $frequence;

        return $this;
    }

    public function getRam(): ?float
    {
        return $this->ram;
    }

    public function setRam(float $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getTypeRam(): ?array
    {
        return $this->typeRam;
    }

    public function setTypeRam(?array $typeRam): self
    {
        $this->typeRam = $typeRam;

        return $this;
    }

    public function getDisque(): ?int
    {
        return $this->disque;
    }

    public function setDisque(int $disque): self
    {
        $this->disque = $disque;

        return $this;
    }

    public function getAgent(): ?Agents
    {
        return $this->agent;
    }

    public function setAgent(?Agents $agent): self
    {
        $this->agent = $agent;

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
            $intervention->setOrdinateur($this);
        }

        return $this;
    }

    public function removeIntervention(Interventions $intervention): self
    {
        if ($this->interventions->removeElement($intervention)) {
            // set the owning side to null (unless already changed)
            if ($intervention->getOrdinateur() === $this) {
                $intervention->setOrdinateur(null);
            }
        }

        return $this;
    }

    public function getType(): ?TypeOrdinateur
    {
        return $this->type;
    }

    public function setType(?TypeOrdinateur $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Fiche[]
     */
    public function getFiches(): Collection
    {
        return $this->fiches;
    }

    public function addFich(Fiche $fich): self
    {
        if (!$this->fiches->contains($fich)) {
            $this->fiches[] = $fich;
            $fich->setOrdinateurs($this);
        }

        return $this;
    }

    public function removeFich(Fiche $fich): self
    {
        if ($this->fiches->removeElement($fich)) {
            // set the owning side to null (unless already changed)
            if ($fich->getOrdinateurs() === $this) {
                $fich->setOrdinateurs(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getType() . " " . $this->getModele() . " " . $this->getProcesseur() . " RAM " . $this->getRam() . " Go HDD " . $this->getDisque() . " Go";
    }
}

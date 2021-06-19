<?php

namespace App\Entity;

use App\Repository\PeripheriquesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PeripheriquesRepository::class)
 */
class Peripheriques
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=Agents::class, inversedBy="peripheriques")
     * @ORM\JoinColumn(nullable=true)
     */
    private $agent;

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

    public function getAgent(): ?Agents
    {
        return $this->agent;
    }

    public function setAgent(?Agents $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    public function __toString()
    {
        return $this->getLibelle();
    }
}

<?php

namespace App\Entity;

use App\Repository\AgentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AgentsRepository::class)
 */
class Agents
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank()
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $prenoms;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $contacts;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $emailPerso;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $emailPro;

    /**
     * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="agents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $service;

    /**
     * @ORM\OneToMany(
     *    targetEntity=Ordinateurs::class, 
     *    mappedBy="agent",
     *    cascade={"persist"}
     * )
     */
    private $ordinateurs;

    /**
     * @ORM\OneToMany(
     *    targetEntity=Peripheriques::class, 
     *    mappedBy="agent",
     *    cascade={"persist"}
     * )
     */
    private $peripheriques;

    public function __construct()
    {
        $this->ordinateurs = new ArrayCollection();
        $this->peripheriques = new ArrayCollection();
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

    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    public function setPrenoms(string $prenoms): self
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    public function getContacts(): ?string
    {
        return $this->contacts;
    }

    public function setContacts(?string $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }

    public function getEmailPerso(): ?string
    {
        return $this->emailPerso;
    }

    public function setEmailPerso(?string $emailPerso): self
    {
        $this->emailPerso = $emailPerso;

        return $this;
    }

    public function getEmailPro(): ?string
    {
        return $this->emailPro;
    }

    public function setEmailPro(?string $emailPro): self
    {
        $this->emailPro = $emailPro;

        return $this;
    }

    public function getService(): ?Services
    {
        return $this->service;
    }

    public function setService(?Services $service): self
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return Collection|Ordinateurs[]
     */
    public function getOrdinateurs(): Collection
    {
        return $this->ordinateurs;
    }

    public function addOrdinateur(Ordinateurs $ordinateur): self
    {
        if (!$this->ordinateurs->contains($ordinateur)) {
            $this->ordinateurs[] = $ordinateur;
            $ordinateur->setAgent($this);
        }

        return $this;
    }

    public function removeOrdinateur(Ordinateurs $ordinateur): self
    {
        if ($this->ordinateurs->removeElement($ordinateur)) {
            // set the owning side to null (unless already changed)
            if ($ordinateur->getAgent() === $this) {
                $ordinateur->setAgent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Peripheriques[]
     */
    public function getPeripheriques(): Collection
    {
        return $this->peripheriques;
    }

    public function addPeripherique(Peripheriques $peripherique): self
    {
        if (!$this->peripheriques->contains($peripherique)) {
            $this->peripheriques[] = $peripherique;
            $peripherique->setAgent($this);
        }

        return $this;
    }

    public function removePeripherique(Peripheriques $peripherique): self
    {
        if ($this->peripheriques->removeElement($peripherique)) {
            // set the owning side to null (unless already changed)
            if ($peripherique->getAgent() === $this) {
                $peripherique->setAgent(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom() . " " . $this->getPrenoms() . " - " . $this->getService();
    }
}

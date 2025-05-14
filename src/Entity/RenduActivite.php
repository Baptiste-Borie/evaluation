<?php

namespace App\Entity;

use App\Repository\RenduActiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RenduActiviteRepository::class)]
class RenduActivite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $urlDocument = null;

    #[ORM\Column]
    private ?\DateTime $dateHeure = null;

    #[ORM\ManyToOne(inversedBy: 'renduActivites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $auteur = null;

    #[ORM\ManyToOne(inversedBy: 'renduActivites')]
    private ?User $validateur = null;

    /**
     * @var Collection<int, Etape>
     */
    #[ORM\ManyToMany(targetEntity: Etape::class, inversedBy: 'renduActivites')]
    private Collection $etapes;

    public function __construct()
    {
        $this->etapes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrlDocument(): ?string
    {
        return $this->urlDocument;
    }

    public function setUrlDocument(string $urlDocument): static
    {
        $this->urlDocument = $urlDocument;

        return $this;
    }

    public function getDateHeure(): ?\DateTime
    {
        return $this->dateHeure;
    }

    public function setDateHeure(\DateTime $dateHeure): static
    {
        $this->dateHeure = $dateHeure;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(?User $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getValidateur(): ?User
    {
        return $this->validateur;
    }

    public function setValidateur(?User $validateur): static
    {
        $this->validateur = $validateur;

        return $this;
    }

    /**
     * @return Collection<int, Etape>
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etape $etape): static
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes->add($etape);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): static
    {
        $this->etapes->removeElement($etape);

        return $this;
    }
}

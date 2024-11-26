<?php

namespace App\Entity;

use App\Repository\SocieteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocieteRepository::class)]
class Societe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $companyName = null;

    /**
     * @var Collection<int, Jobe>
     */
    #[ORM\OneToMany(targetEntity: Jobe::class, mappedBy: 'societe')]
    private Collection $Societe;

    public function __construct()
    {
        $this->Societe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): static
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * @return Collection<int, Jobe>
     */
    public function getSociete(): Collection
    {
        return $this->Societe;
    }

    public function addSociete(Jobe $societe): static
    {
        if (!$this->Societe->contains($societe)) {
            $this->Societe->add($societe);
            $societe->setSociete($this);
        }

        return $this;
    }

    public function removeSociete(Jobe $societe): static
    {
        if ($this->Societe->removeElement($societe)) {
            // set the owning side to null (unless already changed)
            if ($societe->getSociete() === $this) {
                $societe->setSociete(null);
            }
        }

        return $this;
    }
}

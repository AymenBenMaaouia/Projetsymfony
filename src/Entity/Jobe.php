<?php

namespace App\Entity;

use App\Repository\JobeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobeRepository::class)]
class Jobe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"nom Obligatoire!")]
    #[Assert\Length(min:3,minMessage:"min 3 carac")]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email(message:"The email '{{value}}' is not a valid email:")]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'Societe')]
    private ?Societe $societe = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getUsername(): ?string
    {
        return $this->username;
    }
    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getSociete(): ?Societe
    {
        return $this->societe;
    }

    public function setSociete(?Societe $societe): static
    {
        $this->societe = $societe;

        return $this;
    }
}

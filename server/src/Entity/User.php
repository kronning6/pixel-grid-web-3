<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'SEQUENCE')]
    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $email = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: "role_id", referencedColumnName: "role_id")]
    private ?Role $role = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $first_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $last_name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $fg_color = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $bg_color = null;

    public function getId(): ?int
    {
        return $this->user_id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }


    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getFgColor(): ?string
    {
        return $this->fg_color;
    }

    public function setFgColor(?string $fg_color): self
    {
        $this->fg_color = $fg_color;

        return $this;
    }

    public function getBgColor(): ?string
    {
        return $this->bg_color;
    }

    public function setBgColor(?string $bg_color): self
    {
        $this->bg_color = $bg_color;

        return $this;
    }


}

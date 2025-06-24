<?php

namespace Irfan\Phplearning\model;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinTable;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: UserRepo::class)]
#[Table(name: "_User")]
class User
{
    #[Column(type: "integer")]
    #[Id]
    #[GeneratedValue]
    private ?int $id = null;

    #[Column(type: "string")]
    private string $firstName;
    #[Column(type: "string")]
    private string $lastName;
    #[Column(type: "string")]
    private string $email;
    #[Column(type: "string")]
    private string $password;

    #[ManyToMany(targetEntity: Group::class, inversedBy: 'users',)]
    #[JoinTable(name: 'users_groups')]
    private Collection $groups;

    public function __construct()
    {
        $this->groups = new ArrayCollection();
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function comparePassword(string $password):bool
    {
        return password_verify($password,$this->password);
    }
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password,PASSWORD_BCRYPT);
    }

    public function getGroups(): Collection
    {
        return $this->groups;
    }

    public function setGroups(Collection $groups): void
    {
        $this->groups = $groups;
    }


}
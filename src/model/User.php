<?php

namespace Irfan\Phplearning\model;


use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\StringType;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use JetBrains\PhpStorm\Deprecated;
use function DI\string;

#[Entity(repositoryClass: UserRepo::class)]
#[Table(name: "User")]
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





}
<?php

namespace Irfan\Phplearning\model;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: GroupRep::class)]
#[Table(name:"_Group")]
class Group
{
    #[Column(type: "integer")]
    #[Id]
    #[GeneratedValue]
    private ?int $id = null;

    #[Column(type: "string")]
    private string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
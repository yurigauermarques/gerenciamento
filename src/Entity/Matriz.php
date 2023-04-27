<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MatrizRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatrizRepository::class)]
#[ApiResource]
class Matriz
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Res $res = null;

    #[ORM\Column]
    private ?int $numero = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRes(): ?Res
    {
        return $this->res;
    }

    public function setRes(Res $res): self
    {
        $this->res = $res;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
}

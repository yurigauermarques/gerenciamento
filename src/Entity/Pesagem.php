<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PesagemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PesagemRepository::class)]
#[ApiResource]
class Pesagem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $data = null;

    #[ORM\Column]
    private ?float $peso = null;

    #[ORM\ManyToOne(inversedBy: 'pesagens')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Res $res = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getPeso(): ?float
    {
        return $this->peso;
    }

    public function setPeso(float $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getRes(): ?Res
    {
        return $this->res;
    }

    public function setRes(?Res $res): self
    {
        $this->res = $res;

        return $this;
    }
}

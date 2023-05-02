<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\BezerroRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BezerroRepository::class)]
#[ApiResource]
class Bezerro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dataDesmama = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Res $res = null;

    #[ORM\ManyToOne(inversedBy: 'bezerros')]
    private ?Matriz $matriz = null;

    #[ORM\ManyToOne(inversedBy: 'bezerros')]
    private ?EtapaEstacaoMonta $etapaEstacaoMonta = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDataDesmama(): ?\DateTimeInterface
    {
        return $this->dataDesmama;
    }

    public function setDataDesmama(?\DateTimeInterface $dataDesmama): self
    {
        $this->dataDesmama = $dataDesmama;

        return $this;
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

    public function getMatriz(): ?Matriz
    {
        return $this->matriz;
    }

    public function setMatriz(?Matriz $matriz): self
    {
        $this->matriz = $matriz;

        return $this;
    }

    public function getEtapaEstacaoMonta(): ?EtapaEstacaoMonta
    {
        return $this->etapaEstacaoMonta;
    }

    public function setEtapaEstacaoMonta(?EtapaEstacaoMonta $etapaEstacaoMonta): self
    {
        $this->etapaEstacaoMonta = $etapaEstacaoMonta;

        return $this;
    }
}

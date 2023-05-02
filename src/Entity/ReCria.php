<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ReCriaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReCriaRepository::class)]
#[ApiResource]
class ReCria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $previsaoAbate = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Res $res = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrevisaoAbate(): ?\DateTimeInterface
    {
        return $this->previsaoAbate;
    }

    public function setPrevisaoAbate(\DateTimeInterface $previsaoAbate): self
    {
        $this->previsaoAbate = $previsaoAbate;

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
}

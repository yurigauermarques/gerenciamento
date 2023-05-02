<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AplicacaoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AplicacaoRepository::class)]
#[ApiResource]
class Aplicacao
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $data = null;

    #[ORM\ManyToMany(targetEntity: Produto::class)]
    private Collection $produtos;

    #[ORM\ManyToOne(inversedBy: 'aplicacoes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Res $res = null;

    public function __construct()
    {
        $this->produtos = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Produto>
     */
    public function getProdutos(): Collection
    {
        return $this->produtos;
    }

    public function addProduto(Produto $produto): self
    {
        if (!$this->produtos->contains($produto)) {
            $this->produtos->add($produto);
        }

        return $this;
    }

    public function removeProduto(Produto $produto): self
    {
        $this->produtos->removeElement($produto);

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

<?php

namespace App\Entity;

use App\Repository\ResRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResRepository::class)]
class Res
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dataNascimento = null;

    #[ORM\Column(length: 1)]
    private ?string $sexo = null;

    #[ORM\Column(length: 5)]
    private ?string $situcao = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $observacao = null;

    #[ORM\Column(length: 9)]
    private ?string $status = null;

    #[ORM\OneToMany(mappedBy: 'res', targetEntity: Pesagem::class, orphanRemoval: true)]
    private Collection $pesagens;

    #[ORM\OneToMany(mappedBy: 'res', targetEntity: Aplicacao::class, orphanRemoval: true)]
    private Collection $aplicacoes;

    public function __construct()
    {
        $this->pesagens = new ArrayCollection();
        $this->aplicacoes = new ArrayCollection();
    }

    public function __toString()
    {
        $era = '';
        if (null !== $this->getDataNascimento()) {
            $era = $this->getDataNascimento()->format('Y');
        }

        return $this->getNumero().' - '.$era;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDataNascimento(): ?\DateTimeInterface
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(\DateTimeInterface $dataNascimento): self
    {
        $this->dataNascimento = $dataNascimento;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getSitucao(): ?string
    {
        return $this->situcao;
    }

    public function setSitucao(string $situcao): self
    {
        $this->situcao = $situcao;

        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): self
    {
        $this->observacao = $observacao;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Pesagem>
     */
    public function getPesagens(): Collection
    {
        return $this->pesagens;
    }

    public function addPesagem(Pesagem $pesagem): self
    {
        if (!$this->pesagens->contains($pesagem)) {
            $this->pesagens->add($pesagem);
            $pesagem->setRes($this);
        }

        return $this;
    }

    public function removePesagen(Pesagem $pesagen): self
    {
        if ($this->pesagens->removeElement($pesagen)) {
            // set the owning side to null (unless already changed)
            if ($pesagen->getRes() === $this) {
                $pesagen->setRes(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Aplicacao>
     */
    public function getAplicacoes(): Collection
    {
        return $this->aplicacoes;
    }

    public function addAplicaco(Aplicacao $aplicaco): self
    {
        if (!$this->aplicacoes->contains($aplicaco)) {
            $this->aplicacoes->add($aplicaco);
            $aplicaco->setRes($this);
        }

        return $this;
    }

    public function removeAplicaco(Aplicacao $aplicaco): self
    {
        if ($this->aplicacoes->removeElement($aplicaco)) {
            // set the owning side to null (unless already changed)
            if ($aplicaco->getRes() === $this) {
                $aplicaco->setRes(null);
            }
        }

        return $this;
    }
}

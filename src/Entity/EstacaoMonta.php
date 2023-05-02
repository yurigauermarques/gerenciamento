<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EstacaoMontaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstacaoMontaRepository::class)]
#[ApiResource]
class EstacaoMonta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\OneToMany(mappedBy: 'estacaoMonta', targetEntity: EtapaEstacaoMonta::class, orphanRemoval: true)]
    private Collection $etapa;

    public function __construct()
    {
        $this->etapa = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * @return Collection<int, EtapaEstacaoMonta>
     */
    public function getEtapa(): Collection
    {
        return $this->etapa;
    }

    public function addEtapa(EtapaEstacaoMonta $etapa): self
    {
        if (!$this->etapa->contains($etapa)) {
            $this->etapa->add($etapa);
            $etapa->setEstacaoMonta($this);
        }

        return $this;
    }

    public function removeEtapa(EtapaEstacaoMonta $etapa): self
    {
        if ($this->etapa->removeElement($etapa)) {
            // set the owning side to null (unless already changed)
            if ($etapa->getEstacaoMonta() === $this) {
                $etapa->setEstacaoMonta(null);
            }
        }

        return $this;
    }
}

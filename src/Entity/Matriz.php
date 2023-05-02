<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MatrizRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'matriz', targetEntity: Bezerro::class)]
    private Collection $bezerros;

    #[ORM\ManyToMany(targetEntity: EtapaEstacaoMonta::class, mappedBy: 'matrizes')]
    private Collection $etapaEstacaoMontas;

    public function __construct()
    {
        $this->bezerros = new ArrayCollection();
        $this->etapaEstacaoMontas = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Bezerro>
     */
    public function getBezerros(): Collection
    {
        return $this->bezerros;
    }

    public function addBezerro(Bezerro $bezerro): self
    {
        if (!$this->bezerros->contains($bezerro)) {
            $this->bezerros->add($bezerro);
            $bezerro->setMatriz($this);
        }

        return $this;
    }

    public function removeBezerro(Bezerro $bezerro): self
    {
        if ($this->bezerros->removeElement($bezerro)) {
            // set the owning side to null (unless already changed)
            if ($bezerro->getMatriz() === $this) {
                $bezerro->setMatriz(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EtapaEstacaoMonta>
     */
    public function getEtapaEstacaoMontas(): Collection
    {
        return $this->etapaEstacaoMontas;
    }

    public function addEtapaEstacaoMonta(EtapaEstacaoMonta $etapaEstacaoMonta): self
    {
        if (!$this->etapaEstacaoMontas->contains($etapaEstacaoMonta)) {
            $this->etapaEstacaoMontas->add($etapaEstacaoMonta);
            $etapaEstacaoMonta->addMatrize($this);
        }

        return $this;
    }

    public function removeEtapaEstacaoMonta(EtapaEstacaoMonta $etapaEstacaoMonta): self
    {
        if ($this->etapaEstacaoMontas->removeElement($etapaEstacaoMonta)) {
            $etapaEstacaoMonta->removeMatrize($this);
        }

        return $this;
    }
}

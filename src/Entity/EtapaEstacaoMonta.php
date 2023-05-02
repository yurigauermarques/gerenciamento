<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EtapaEstacaoMontaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtapaEstacaoMontaRepository::class)]
#[ApiResource]
class EtapaEstacaoMonta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'etapa')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EstacaoMonta $estacaoMonta = null;

    #[ORM\Column(length: 11)]
    private ?string $tipo = null;

    #[ORM\ManyToMany(targetEntity: Matriz::class, inversedBy: 'etapaEstacaoMontas')]
    private Collection $matrizes;

    #[ORM\OneToMany(mappedBy: 'etapaEstacaoMonta', targetEntity: Bezerro::class)]
    private Collection $bezerros;

    public function __construct()
    {
        $this->matrizes = new ArrayCollection();
        $this->bezerros = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstacaoMonta(): ?EstacaoMonta
    {
        return $this->estacaoMonta;
    }

    public function setEstacaoMonta(?EstacaoMonta $estacaoMonta): self
    {
        $this->estacaoMonta = $estacaoMonta;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * @return Collection<int, Matriz>
     */
    public function getMatrizes(): Collection
    {
        return $this->matrizes;
    }

    public function addMatrize(Matriz $matrize): self
    {
        if (!$this->matrizes->contains($matrize)) {
            $this->matrizes->add($matrize);
        }

        return $this;
    }

    public function removeMatrize(Matriz $matrize): self
    {
        $this->matrizes->removeElement($matrize);

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
            $bezerro->setEtapaEstacaoMonta($this);
        }

        return $this;
    }

    public function removeBezerro(Bezerro $bezerro): self
    {
        if ($this->bezerros->removeElement($bezerro)) {
            // set the owning side to null (unless already changed)
            if ($bezerro->getEtapaEstacaoMonta() === $this) {
                $bezerro->setEtapaEstacaoMonta(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\SalaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalaRepository::class)]
class Sala
{
    #[ORM\Id]
    #[ORM\Column(name: 'NUMERO_SALA')]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'NUMERO_SALA', targetEntity: ReservaSala::class)]
    private Collection $reservaSalas;

    public function __construct()
    {
        $this->reservaSalas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Collection<int, ReservaSala>
     */
    public function getReservaSalas(): Collection
    {
        return $this->reservaSalas;
    }

    public function addReservaSala(ReservaSala $reservaSala): self
    {
        if (!$this->reservaSalas->contains($reservaSala)) {
            $this->reservaSalas->add($reservaSala);
            $reservaSala->setNumeroSala($this);
        }

        return $this;
    }

    public function removeReservaSala(ReservaSala $reservaSala): self
    {
        if ($this->reservaSalas->removeElement($reservaSala)) {
            // set the owning side to null (unless already changed)
            if ($reservaSala->getNumeroSala() === $this) {
                $reservaSala->setNumeroSala(null);
            }
        }

        return $this;
    }
}

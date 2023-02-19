<?php

namespace App\Entity;

use App\Repository\MaterialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialRepository::class)]
class Material
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ID')]
    private ?int $id = null;

    #[ORM\Column(name: 'NOMBRE', type: Types::STRING, length: 255, nullable: false)]
    private ?string $nombre = null;

    #[ORM\Column(name: 'STOCK', type: Types::INTEGER, nullable: false)]
    private ?int $stock = null;

    #[ORM\Column(name: 'ARMARIO', type: Types::INTEGER, nullable: false)]
    private ?int $armario = null;

    #[ORM\OneToMany(mappedBy: 'ID_MATERIAL', targetEntity: ReservaMaterial::class)]
    private Collection $reservaMaterials;

    public function __construct()
    {
        $this->reservaMaterials = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getArmario(): ?int
    {
        return $this->armario;
    }

    public function setArmario(int $armario): self
    {
        $this->armario = $armario;

        return $this;
    }

    /**
     * @return Collection<int, ReservaMaterial>
     */
    public function getReservaMaterials(): Collection
    {
        return $this->reservaMaterials;
    }

    public function addReservaMaterial(ReservaMaterial $reservaMaterial): self
    {
        if (!$this->reservaMaterials->contains($reservaMaterial)) {
            $this->reservaMaterials->add($reservaMaterial);
            $reservaMaterial->setIdMaterial($this);
        }

        return $this;
    }

    public function removeReservaMaterial(ReservaMaterial $reservaMaterial): self
    {
        if ($this->reservaMaterials->removeElement($reservaMaterial)) {
            // set the owning side to null (unless already changed)
            if ($reservaMaterial->getIdMaterial() === $this) {
                $reservaMaterial->setIdMaterial(null);
            }
        }

        return $this;
    }
}

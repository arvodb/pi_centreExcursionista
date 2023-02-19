<?php

namespace App\Entity;

use App\Repository\ReservaMaterialRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaMaterialRepository::class)]
class ReservaMaterial
{

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'reservaMaterials')]
    #[ORM\JoinColumn(name: 'ID_USUARIO' , referencedColumnName: 'ID')]
    private ?Usuario $idUsuario = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'reservaMaterials')]
    #[ORM\JoinColumn(name: 'ID_MATERIAL' , referencedColumnName: 'ID')]
    private ?Material $idMaterial = null;

    #[ORM\Column(name: 'CANTIDAD', type: Types::INTEGER, nullable: false)]
    private ?int $cantidad = null;

    #[ORM\Id]
    #[ORM\Column(name: 'FECHA_RESERVA', type: Types::STRING, nullable: false)]
    private ?string $fechaReserva = null;

    #[ORM\Column(name: 'FECHA_DEVOLUCION', type: Types::DATE_MUTABLE, nullable: false)]
    private ?\DateTimeInterface $fechaDevolucion = null;

    #[ORM\Column(name: 'ESTADO', type: Types::STRING, length: 15, nullable: false)]
    private ?string $estado = null;

    public function getIdUsuario(): ?Usuario
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuario $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    public function getIdMaterial(): ?Material
    {
        return $this->idMaterial;
    }

    public function setIdMaterial(?Material $idMaterial): self
    {
        $this->idMaterial = $idMaterial;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getFechaReserva(): ?string
    {
        return $this->fechaReserva;
    }

    public function setFechaReserva(string $fechaReserva): self
    {
        $this->fechaReserva = $fechaReserva;

        return $this;
    }

    public function getFechaDevolucion(): ?\DateTimeInterface
    {
        return $this->fechaDevolucion;
    }

    public function setFechaDevolucion(\DateTimeInterface $fechaDevolucion): self
    {
        $this->fechaDevolucion = $fechaDevolucion;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}

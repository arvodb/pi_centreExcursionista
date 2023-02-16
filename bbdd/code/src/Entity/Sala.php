<?php

namespace App\Entity;

use App\Repository\SalaRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SalaRepository::class)]
class Sala
{
    #[ORM\Id]
    #[ORM\Column(name: 'NOMBRE_SALA')]
    private ?int $id = null;

    #[ORM\Column(name: 'FECHA_RESERVA', type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechaReserva = null;

    #[ORM\ManyToOne(inversedBy: 'salas')]
    #[ORM\JoinColumn(name: 'ID_USUARIO', referencedColumnName: 'ID', nullable: true)]
    private ?Usuario $idUsuario = null;

    #[ORM\Column(name: 'ESTADO', type: Types::STRING, length: 20, nullable: false)]
    private ?string $estado = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getFechaReserva(): ?\DateTimeInterface
    {
        return $this->fechaReserva;
    }

    public function setFechaReserva(\DateTimeInterface $fechaReserva): self
    {
        $this->fechaReserva = $fechaReserva;

        return $this;
    }

    public function getIdUsuario(): ?Usuario
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuario $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

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

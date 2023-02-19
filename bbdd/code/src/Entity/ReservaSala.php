<?php

namespace App\Entity;

use App\Repository\ReservaSalaRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: ReservaSalaRepository::class)]
class ReservaSala
{

    #[ORM\Id]
    #[ORM\Column(name: 'FECHA_RESERVA', type: Types::STRING, length: 20, nullable: false)]
    private ?string $fechaReserva = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'reservaSalas')]
    #[ORM\JoinColumn(name: 'ID_USUARIO' , referencedColumnName: 'ID')]
    private ?Usuario $idUsuario = null;

    #[ORM\Id]
    #[ORM\Column(name: 'HORARIO', type: Types::STRING, length: 20, nullable: false)]
    private ?string $horario = null;

    #[ORM\Id]
    #[ORM\ManyToOne(inversedBy: 'reservaSalas')]
    #[ORM\JoinColumn(name: 'NUMERO_SALA' , referencedColumnName: 'NUMERO_SALA')]
    private ?Sala $idSala = null;

    public function getFechaReserva(): ?string
    {
        return $this->fechaReserva;
    }

    public function setFechaReserva(string $fechaReserva): self
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

    public function getHorario(): ?string
    {
        return $this->horario;
    }

    public function setHorario(string $horario): self
    {
        $this->horario = $horario;

        return $this;
    }

    public function getIdSala(): ?Sala
    {
        return $this->idSala;
    }

    public function setIdSala(?Sala $numeroSala): self
    {
        $this->idSala = $numeroSala;

        return $this;
    }
}

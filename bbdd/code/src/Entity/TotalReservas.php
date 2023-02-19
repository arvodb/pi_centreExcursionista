<?php

namespace App\Entity;

use App\Repository\TotalReservasRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: TotalReservasRepository::class)]
class TotalReservas
{
    #[ORM\Id]
    #[ORM\Column(name: 'NOMBRE', type: Types::STRING, length: 20, nullable: false)]
    private ?string $nombre = null;

    #[ORM\Column(name: 'TOTAL', type: Types::INTEGER, nullable: false)]
    private ?int $total = null;

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

        return $this;
    }
}

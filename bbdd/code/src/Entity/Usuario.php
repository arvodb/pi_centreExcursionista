<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ID')]
    private ?int $id = null;

    #[ORM\Column(name: 'NOMBRE_USUARIO', type: Types::STRING, length: 20, nullable: false)]
    private ?string $nombreUsuario = null;

    #[ORM\Column(name: 'CONTRASEÑA', type: Types::STRING, length: 20, nullable: false)]
    private ?string $contrasena = null;

    #[ORM\Column(name: 'CORREO', type: Types::STRING, length: 30, nullable: false)]
    private ?string $correo = null;

    #[ORM\Column(name: 'PRIVILEGIO', type: Types::STRING, length: 20, nullable: false)]
    private ?string $privilegio = null;

    #[ORM\OneToMany(mappedBy: 'ID_USUARIO', targetEntity: ReservaMaterial::class)]
    private Collection $reservaMaterials;

    #[ORM\OneToMany(mappedBy: 'ID_USUARIO', targetEntity: ReservaSala::class)]
    private Collection $reservaSalas;

    public function __construct()
    {
        $this->reservaMaterials = new ArrayCollection();
        $this->reservaSalas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreUsuario(): ?string
    {
        return $this->nombreUsuario;
    }

    public function setNombreUsuario(string $nombreUsuario): self
    {
        $this->nombreUsuario = $nombreUsuario;

        return $this;
    }

    public function getContrasena(): ?string
    {
        return $this->contrasena;
    }

    public function setContrasena(string $contrasena): self
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getPrivilegio(): ?string
    {
        return $this->privilegio;
    }

    public function setPrivilegio(string $privilegio): self
    {
        $this->privilegio = $privilegio;

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
            $reservaMaterial->setIdUsuario($this);
        }

        return $this;
    }

    public function removeReservaMaterial(ReservaMaterial $reservaMaterial): self
    {
        if ($this->reservaMaterials->removeElement($reservaMaterial)) {
            // set the owning side to null (unless already changed)
            if ($reservaMaterial->getIdUsuario() === $this) {
                $reservaMaterial->setIdUsuario(null);
            }
        }

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
            $reservaSala->setIdUsuario($this);
        }

        return $this;
    }

    public function removeReservaSala(ReservaSala $reservaSala): self
    {
        if ($this->reservaSalas->removeElement($reservaSala)) {
            // set the owning side to null (unless already changed)
            if ($reservaSala->getIdUsuario() === $this) {
                $reservaSala->setIdUsuario(null);
            }
        }

        return $this;
    }
}

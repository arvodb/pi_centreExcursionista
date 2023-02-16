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

    #[ORM\OneToMany(mappedBy: 'ID_USUARIO', targetEntity: Sala::class)]
    private Collection $salas;

    #[ORM\OneToMany(mappedBy: 'ID_USUARIO', targetEntity: ReservaMaterial::class)]
    private Collection $reservaMaterials;

    public function __construct()
    {
        $this->salas = new ArrayCollection();
        $this->reservaMaterials = new ArrayCollection();
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
     * @return Collection<int, Sala>
     */
    public function getSalas(): Collection
    {
        return $this->salas;
    }

    public function addSala(Sala $sala): self
    {
        if (!$this->salas->contains($sala)) {
            $this->salas->add($sala);
            $sala->setIdUsuario($this);
        }

        return $this;
    }

    public function removeSala(Sala $sala): self
    {
        if ($this->salas->removeElement($sala)) {
            // set the owning side to null (unless already changed)
            if ($sala->getIdUsuario() === $this) {
                $sala->setIdUsuario(null);
            }
        }

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
}

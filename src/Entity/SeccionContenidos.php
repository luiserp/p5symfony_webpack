<?php

namespace App\Entity;

use App\Repository\SeccionContenidosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeccionContenidosRepository::class)
 */
class SeccionContenidos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity=Asignatura::class, inversedBy="seccionesContenidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $asignatura;

    /**
     * @ORM\OneToMany(targetEntity=Contenido::class, mappedBy="seccion")
     */
    private $contenidos;

    public function __construct()
    {
        $this->contenidos = new ArrayCollection();
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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getAsignatura(): ?Asignatura
    {
        return $this->asignatura;
    }

    public function setAsignatura(?Asignatura $asignatura): self
    {
        $this->asignatura = $asignatura;

        return $this;
    }

    /**
     * @return Collection|Contenido[]
     */
    public function getContenidos(): Collection
    {
        return $this->contenidos;
    }

    public function addContenido(Contenido $contenido): self
    {
        if (!$this->contenidos->contains($contenido)) {
            $this->contenidos[] = $contenido;
            $contenido->setSeccion($this);
        }

        return $this;
    }

    public function removeContenido(Contenido $contenido): self
    {
        if ($this->contenidos->removeElement($contenido)) {
            // set the owning side to null (unless already changed)
            if ($contenido->getSeccion() === $this) {
                $contenido->setSeccion(null);
            }
        }

        return $this;
    }
}

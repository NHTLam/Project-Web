<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\ManyToMany(targetEntity: Courses::class)]
    private $Coures;

    #[ORM\ManyToOne(targetEntity: Classes::class)]
    private $Classes;

    public function __construct()
    {
        $this->Coures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Courses>
     */
    public function getCoures(): Collection
    {
        return $this->Coures;
    }

    public function addCoure(Courses $coure): self
    {
        if (!$this->Coures->contains($coure)) {
            $this->Coures[] = $coure;
        }

        return $this;
    }

    public function removeCoure(Courses $coure): self
    {
        $this->Coures->removeElement($coure);

        return $this;
    }

    public function getClasses(): ?Classes
    {
        return $this->Classes;
    }

    public function setClasses(?Classes $Classes): self
    {
        $this->Classes = $Classes;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\CoursesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursesRepository::class)]
class Courses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'date')]
    private $startDate;

    #[ORM\Column(type: 'date')]
    private $endDate;

    #[ORM\ManyToMany(targetEntity: Lectures::class)]
    private $Lecturer;

    #[ORM\ManyToMany(targetEntity: Classes::class, inversedBy: 'courses')]
    private $Classes;

    public function __construct()
    {
        $this->Lecturer = new ArrayCollection();
        $this->Classes = new ArrayCollection();
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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection<int, Lectures>
     */
    public function getLecturer(): Collection
    {
        return $this->Lecturer;
    }

    public function addLecturer(Lectures $lecturer): self
    {
        if (!$this->Lecturer->contains($lecturer)) {
            $this->Lecturer[] = $lecturer;
        }

        return $this;
    }

    public function removeLecturer(Lectures $lecturer): self
    {
        $this->Lecturer->removeElement($lecturer);

        return $this;
    }

    /**
     * @return Collection<int, Classes>
     */
    public function getClasses(): Collection
    {
        return $this->Classes;
    }

    public function addClass(Classes $class): self
    {
        if (!$this->Classes->contains($class)) {
            $this->Classes[] = $class;
        }

        return $this;
    }

    public function removeClass(Classes $class): self
    {
        $this->Classes->removeElement($class);

        return $this;
    }
}

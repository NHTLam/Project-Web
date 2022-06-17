<?php

namespace App\Entity;

use App\Repository\LecturesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LecturesRepository::class)]
class Lectures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Classes::class)]
    private $Classes;

    #[ORM\ManyToMany(targetEntity: Courses::class)]
    private $Courses;

    public function __construct()
    {
        $this->Classes = new ArrayCollection();
        $this->Courses = new ArrayCollection();
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

    /**
     * @return Collection<int, Courses>
     */
    public function getCourses(): Collection
    {
        return $this->Courses;
    }

    public function addCourse(Courses $course): self
    {
        if (!$this->Courses->contains($course)) {
            $this->Courses[] = $course;
        }

        return $this;
    }

    public function removeCourse(Courses $course): self
    {
        $this->Courses->removeElement($course);

        return $this;
    }
}

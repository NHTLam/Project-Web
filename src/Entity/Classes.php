<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
class Classes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $StdQuantity;

    #[ORM\Column(type: 'string', length: 255)]
    private $Student;

    #[ORM\ManyToMany(targetEntity: Courses::class, mappedBy: 'Classes')]
    private $courses;

    #[ORM\ManyToMany(targetEntity: Student::class, inversedBy: 'classes')]
    private $studentList;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
        $this->studentList = new ArrayCollection();
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

    public function getStdQuantity(): ?int
    {
        return $this->StdQuantity;
    }

    public function setStdQuantity(int $StdQuantity): self
    {
        $this->StdQuantity = $StdQuantity;

        return $this;
    }

    public function getStudent()
    {
        return $this->Student;
    }

    public function setStudent($Student): self
    {
        $this->Student = $Student;

        return $this;
    }

    /**
     * @return Collection<int, Courses>
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Courses $course): self
    {
        if (!$this->courses->contains($course)) {
            $this->courses[] = $course;
            $course->addClass($this);
        }

        return $this;
    }

    public function removeCourse(Courses $course): self
    {
        if ($this->courses->removeElement($course)) {
            $course->removeClass($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudentList(): Collection
    {
        return $this->studentList;
    }

    public function addStudentList(Student $studentList): self
    {
        if (!$this->studentList->contains($studentList)) {
            $this->studentList[] = $studentList;
        }

        return $this;
    }

    public function removeStudentList(Student $studentList): self
    {
        $this->studentList->removeElement($studentList);

        return $this;
    }
}

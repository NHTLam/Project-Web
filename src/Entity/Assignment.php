<?php

namespace App\Entity;

use App\Repository\AssignmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssignmentRepository::class)]
class Assignment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date')]
    private $DateSubmit;

    #[ORM\Column(type: 'string', length: 255)]
    private $file;

    #[ORM\ManyToMany(mappedBy: 'assignment', targetEntity: Student::class)]
    private $Student;

    #[ORM\Column(type: 'string', length: 255)]
    private $Title;

    public function __construct()
    {
        $this->Student = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function geDateSubmit(): ?\DateTimeInterface
    {
        return $this->DateSubmit;
    }

    public function setDateSubmit(\DateTimeInterface $DateSubmit): self
    {
        $this->DateSubmit = $DateSubmit;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file): self
    {
        if($file!=null){
            $this->file = $file;
        }       

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudent(): Collection
    {
        return $this->Student;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->Student->contains($student)) {
            $this->Student[] = $student;
            $student->setAssignment($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->Student->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getAssignment() === $this) {
                $student->setAssignment(null);
            }
        }

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }
}

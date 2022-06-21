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
    private $deadline;

    #[ORM\Column(type: 'string', length: 255)]
    private $question;


    #[ORM\Column(type: 'string', length: 255)]
    private $Title;

    #[ORM\ManyToMany(targetEntity: Student::class, inversedBy: 'assignment')]
    private $Student;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $answer;

    #[ORM\Column(type: 'date', nullable: true)]
    private $datesubmit;

    #[ORM\Column(type: 'float', nullable: true)]
    private $grade;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $comment;

    #[ORM\Column(type: 'date', nullable: true)]
    private $datefeedback;


    public function __construct()
    {
        $this->Student = new ArrayCollection();   

    }

    



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion($question): self
    {       
        $this->question = $question;         

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
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        $this->Student->removeElement($student);

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(?string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getDatesubmit(): ?\DateTimeInterface
    {
        return $this->datesubmit;
    }

    public function setDatesubmit(?\DateTimeInterface $datesubmit): self
    {
        $this->datesubmit = $datesubmit;

        return $this;
    }

    public function getGrade(): ?float
    {
        return $this->grade;
    }

    public function setGrade(?float $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getDatefeedback(): ?\DateTimeInterface
    {
        return $this->datefeedback;
    }

    public function setDatefeedback(?\DateTimeInterface $datefeedback): self
    {
        $this->datefeedback = $datefeedback;

        return $this;
    }


}

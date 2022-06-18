<?php

namespace App\Entity;

use App\Entity\Assignment;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FeedbackRepository;

#[ORM\Entity(repositoryClass: FeedbackRepository::class)]
class Feedback
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $grade;

    #[ORM\Column(type: 'string', length: 255)]
    private $comment;

    #[ORM\Column(type: 'date')]
    private $DateFeedback;

    #[ORM\OneToOne(targetEntity: Assignment::class, cascade: ['persist', 'remove'])]
    private $Assignment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?float
    {
        return $this->grade;
    }

    public function setGrade(float $grade): self
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

    public function getDateFeedback(): ?\DateTimeInterface
    {
        return $this->DateFeedback;
    }

    public function setDateFeedback(\DateTimeInterface $DateFeedback): self
    {
        $this->DateFeedback = $DateFeedback;

        return $this;
    }

    public function getAssignment(): ?Assignment
    {
        return $this->Assignment;
    }

    public function setAssignment(?Assignment $Assignment): self
    {
        $this->Assignment = $Assignment;

        return $this;
    }
}

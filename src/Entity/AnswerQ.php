<?php

namespace App\Entity;

use App\Repository\AnswerQRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: AnswerQRepository::class)]
class AnswerQ
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $answer;

    #[ORM\Column(type: 'date')]
    private $datesubmit;

    #[ORM\OneToOne(targetEntity: Assignment::class, cascade: ['persist', 'remove'])]
    private $assignment;

  
    // public function __construct()
    // {
    //     $this->assignment = new ArrayCollection();

    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getDatesubmit(): ?\DateTimeInterface
    {
        return $this->datesubmit;
    }

    public function setDatesubmit(\DateTimeInterface $datesubmit): self
    {
        $this->datesubmit = $datesubmit;

        return $this;
    }

    public function getAssignment(): ?Assignment
    {
        return $this->assignment;
    }

    public function setAssignment(?Assignment $assignment): self
    {
        $this->assignment = $assignment;

        return $this;
    }


    
}

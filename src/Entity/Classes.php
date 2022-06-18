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

    #[ORM\ManyToMany(targetEntity: self::class)]
    private $Course;

    public function __construct()
    {
        $this->Course = new ArrayCollection();
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

    /**
     * @return Collection<int, self>
     */
    public function getCourse(): Collection
    {
        return $this->Course;
    }

    public function addCourse(self $course): self
    {
        if (!$this->Course->contains($course)) {
            $this->Course[] = $course;
        }

        return $this;
    }

    public function removeCourse(self $course): self
    {
        $this->Course->removeElement($course);

        return $this;
    }
}

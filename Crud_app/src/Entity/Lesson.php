<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonRepository::class)]
class Lesson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $location;

    #[ORM\Column(type: 'string', length: 255)]
    private $date;

    #[ORM\Column(type: 'guid')]
    private $time;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\ManyToOne(targetEntity: DrivingInstructor::class, inversedBy: 'lesson')]
    private $drivingInstructor;

    #[ORM\ManyToOne(targetEntity: Student::class, inversedBy: 'lesson')]
    private $student;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $DrivingIntsructorEmail;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $StudentEmail;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDrivingInstructor(): ?DrivingInstructor
    {
        return $this->drivingInstructor;
    }

    public function setDrivingInstructor(?DrivingInstructor $drivingInstructor): self
    {
        $this->drivingInstructor = $drivingInstructor;

        return $this;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getDrivingIntsructorEmail(): ?string
    {
        return $this->DrivingIntsructorEmail;
    }

    public function setDrivingIntsructorEmail(?string $DrivingIntsructorEmail): self
    {
        $this->DrivingIntsructorEmail = $DrivingIntsructorEmail;

        return $this;
    }

    public function getStudentEmail(): ?string
    {
        return $this->StudentEmail;
    }

    public function setStudentEmail(?string $StudentEmail): self
    {
        $this->StudentEmail = $StudentEmail;

        return $this;
    }
}

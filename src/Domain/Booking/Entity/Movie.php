<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\ValueObject\Duration;
use App\Domain\Booking\Entity\ValueObject\MovieId;
use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity() */
class Movie
{
    /** @ORM\Embedded(columnPrefix=false) */
    private MovieId $id;

    /** @ORM\Column() */
    private string $name;

    /** @ORM\Embedded() */
    private Duration $duration;

    public function __construct(MovieId $id, string $name, Duration $duration)
    {
        $this->id = $id;
        $this->name = $name;
        $this->duration = $duration;
    }

    public function getId(): MovieId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDuration(): Duration
    {
        return $this->duration;
    }
}

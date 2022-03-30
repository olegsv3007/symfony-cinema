<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\ValueObject\Duration;
use App\Domain\Booking\Entity\ValueObject\MovieId;

class Movie
{
    public function __construct(
        private MovieId $id,
        private string $name,
        private Duration $duration,
    ) { }

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

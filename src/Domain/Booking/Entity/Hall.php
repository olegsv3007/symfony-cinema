<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\ValueObject\HallId;

class Hall
{
    public function __construct(
        private HallId $id,
        private int $totalSeats,
    ) { }

    public function getId(): HallId
    {
        return $this->id;
    }

    public function getTotalSeats(): int
    {
        return $this->totalSeats;
    }
}

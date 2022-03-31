<?php

namespace App\Domain\Booking\Entity\ValueObject;

use DateInterval;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/** @ORM\Embeddable() */
final class Duration
{
    /** @ORM\Column(type="integer") */
    private int $minutes;

    public function __construct(int $minutes)
    {
        $this->validateMinutes($minutes);
        $this->minutes = $minutes;
    }

    public function getHours(): int
    {
        return $this->minutes / 60;
    }

    public function getMinutes(): int
    {
        return $this->minutes % 60;
    }

    public function getDateInterval(): DateInterval
    {
        return new DateInterval(sprintf('PT%dM', $this->minutes));
    }

    private function validateMinutes(int $minutes): void
    {
        if ($minutes < 0) {
            throw new InvalidArgumentException();
        }
    }
}

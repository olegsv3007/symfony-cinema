<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\ValueObject\HallId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @final
 */
class Hall
{
    /** @ORM\Embedded(columnPrefix=false) */
    private HallId $id;

    /** @ORM\Column(type="smallint") */
    private int $totalSeats;

    public function __construct(HallId $id, int $totalSeats)
    {
        $this->id = $id;
        $this->totalSeats = $totalSeats;
    }

    public function getId(): HallId
    {
        return $this->id;
    }

    public function getTotalSeats(): int
    {
        return $this->totalSeats;
    }
}

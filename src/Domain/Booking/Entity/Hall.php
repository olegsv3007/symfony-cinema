<?php

namespace App\Domain\Booking\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity()
 * @final
 */
class Hall
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="doctrine.uuid_generator")
     */
    private Uuid $id;

    /** @ORM\Column(type="smallint") */
    private int $totalSeats;

    public function __construct(int $totalSeats)
    {
        $this->totalSeats = $totalSeats;
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getTotalSeats(): int
    {
        return $this->totalSeats;
    }
}

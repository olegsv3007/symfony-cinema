<?php

namespace App\Domain\Booking\Entity\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 * @final
 */
class PhoneNumber
{
    /** @ORM\Column(name="client_phone_number", type="string") */
    private string $number;

    public function __construct(string $number)
    {
        $this->number = $number;
    }

    public function getNumber(): string
    {
        return $this->number;
    }
}

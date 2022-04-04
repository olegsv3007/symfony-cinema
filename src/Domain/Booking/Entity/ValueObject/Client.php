<?php

namespace App\Domain\Booking\Entity\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 * @final
 */
class Client
{
    /** @ORM\Column(type="string") */
    private string $clientName;

    /** @ORM\Embedded(columnPrefix=false) */
    private PhoneNumber $phoneNumber;

    public function __construct(string $clientName, PhoneNumber $phoneNumber)
    {
        $this->clientName = $clientName;
        $this->phoneNumber = $phoneNumber;
    }

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function getPhoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }
}

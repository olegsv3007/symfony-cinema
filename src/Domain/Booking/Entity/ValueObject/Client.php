<?php

namespace App\Domain\Booking\Entity\ValueObject;

class Client
{
    public function __construct(
        private string $clientName,
        private PhoneNumber $phoneNumber,
    ) { }

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function getPhoneNumber(): PhoneNumber
    {
        return $this->phoneNumber;
    }
}

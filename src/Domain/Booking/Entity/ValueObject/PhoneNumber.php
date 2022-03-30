<?php

namespace App\Domain\Booking\Entity\ValueObject;

use InvalidArgumentException;

class PhoneNumber
{
    public function __construct(private string $number)
    {
        $this->validatePhoneNumber($number);
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function validatePhoneNumber(string $number): void
    {
        $this->validatePhoneNumberFormat($number);
    }

    public function validatePhoneNumberFormat(string $number): void
    {
        if (!preg_match('/^[0-9]{9,14}\z/', $number)) {
            throw new InvalidArgumentException();
        }
    }
}

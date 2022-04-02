<?php

namespace App\Domain\Booking\Entity\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/**
 * @ORM\Embeddable()
 * @final
 */
class PhoneNumber
{
    /** @ORM\Column(name="client_phone_number") */
    private string $number;

    public function __construct(string $number)
    {
        $this->validatePhoneNumber($number);
        $this->number = $number;
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

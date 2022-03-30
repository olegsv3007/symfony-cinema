<?php

namespace App\Domain\Booking\Entity\ValueObject;

abstract class AbstractId
{
    protected string $id;

    public function __construct(string $id = '')
    {
        $this->id = $id ?: uniqid();
    }

    public function getId(): int
    {
        return $this->id;
    }
}

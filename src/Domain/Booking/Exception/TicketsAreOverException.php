<?php

namespace App\Domain\Booking\Exception;

final class TicketsAreOverException extends \Exception
{
    public function __construct()
    {
        $this->message = 'Билеты кончились';
    }
}

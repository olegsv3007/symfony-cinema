<?php

namespace App\Domain\Booking\Command\Factory;

use App\Domain\Booking\Command\BookTicketCommand;
use Symfony\Component\HttpFoundation\Request;

final class BookTicketCommandFactory
{
    public static function createFromRequest(Request $request): BookTicketCommand
    {
        $sessionId = $request->get('session')->getId();
        $clientName = $request->get('name');
        $clientPhoneNumber = $request->get('phone_number');

        return new BookTicketCommand($sessionId, $clientName, $clientPhoneNumber);
    }
}

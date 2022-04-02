<?php

namespace App\Domain\Booking\Entity\TransferObject;

use Symfony\Component\HttpFoundation\Request;

final class BookTicketDTOFactory
{
    public static function createFromRequest(Request $request): BookTicketDTO
    {
        $bookTicketDTO = new BookTicketDTO();
        $bookTicketDTO->clientName = $request->get('name');
        $bookTicketDTO->phoneNumber = $request->get('phone_number');

        return $bookTicketDTO;
    }
}

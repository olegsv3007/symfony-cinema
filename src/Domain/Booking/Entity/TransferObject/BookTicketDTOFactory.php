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

    public static function create(string $clientName, string $phoneNumber): BookTicketDTO
    {
        $bookTicketDTO = new BookTicketDTO();
        $bookTicketDTO->clientName = $clientName;
        $bookTicketDTO->phoneNumber = $phoneNumber;

        return $bookTicketDTO;
    }
}

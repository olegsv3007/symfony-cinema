<?php

namespace App\Domain\Booking\Command;

use App\Domain\Booking\Entity\TransferObject\BookTicketDTO;

final class BookTicketCommand
{
    public function __construct(
        public int $sessionId,
        public BookTicketDTO $clientData,
    ) { }
}

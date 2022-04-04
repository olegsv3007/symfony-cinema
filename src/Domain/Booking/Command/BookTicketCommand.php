<?php

namespace App\Domain\Booking\Command;

use App\Domain\Booking\Entity\TransferObject\BookTicketDTO;
use Symfony\Component\Validator\Constraints as Assert;

final class BookTicketCommand
{
    /**
     * @Assert\NotNull
     * @Assert\Valid
     */
    public BookTicketDTO $clientData;

    public function __construct(public int $sessionId, BookTicketDTO $clientData)
    {
        $this->sessionId = $sessionId;
        $this->clientData = $clientData;
    }
}

<?php

namespace App\Domain\Booking\Command;

use App\Domain\Booking\Repository\SessionRepository;
use App\Domain\Booking\Repository\TicketRepository;

final class BookTicketCommandHandler
{
    public function __construct(
        private SessionRepository $sessionRepository,
        private TicketRepository $ticketRepository,
    ) { }

    public function __invoke(BookTicketCommand $command): void
    {
        $client = $command->clientData;
        $session = $this->sessionRepository->find($command->sessionId);

        $session->bookTicket($client, $this->ticketRepository);
    }
}

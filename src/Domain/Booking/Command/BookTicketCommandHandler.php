<?php

namespace App\Domain\Booking\Command;

use App\Domain\Booking\Repository\SessionRepository;

final class BookTicketCommandHandler
{
    public function __construct(private SessionRepository $sessionRepository)
    {
    }

    public function __invoke(BookTicketCommand $command): void
    {
        $client = $command->clientData;
        $session = $this->sessionRepository->findById($command->sessionId);

        $session->bookTicket($client);
        $this->sessionRepository->add($session);
    }
}

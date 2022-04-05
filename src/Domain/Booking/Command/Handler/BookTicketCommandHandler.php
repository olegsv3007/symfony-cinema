<?php

namespace App\Domain\Booking\Command\Handler;

use App\Domain\Booking\Command\BookTicketCommand;
use App\Domain\Booking\Entity\TransferObject\BookTicketDTOFactory;
use App\Domain\Booking\Repository\SessionRepository;

final class BookTicketCommandHandler
{
    public function __construct(private SessionRepository $sessionRepository)
    {
    }

    public function __invoke(BookTicketCommand $command): void
    {
        $client = BookTicketDTOFactory::create($command->clientName, $command->phoneNumber);
        $session = $this->sessionRepository->findById($command->sessionId);

        $session->bookTicket($client);
        $this->sessionRepository->save($session);
    }
}

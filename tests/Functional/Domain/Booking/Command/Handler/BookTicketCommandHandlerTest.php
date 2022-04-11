<?php

namespace App\Tests\Functional\Domain\Booking\Command\Handler;

use App\Domain\Booking\Command\BookTicketCommand;
use App\Domain\Booking\Entity\Session;
use App\Tests\DataFixtures\SessionWithFreeTicketsFixture;
use App\Tests\DataFixtures\SessionWithoutFreeTicketsFixture;
use App\Tests\Functional\FunctionalTestCase;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Uid\Uuid;

final class BookTicketCommandHandlerTest extends FunctionalTestCase
{
    public function testCorrectCommandCanBeHandleForSessionWithFreeTickets(): void
    {
        $session = $this->getSessionWithFreeTickets();
        $command = $this->createNewCommand($session->getId());

        $this->bus->dispatch($command);

        $this->assertCount(1, $session->getTickets());
    }

    public function testCorrectCommandThrowExceptionForSessionWithoutFreeTickets(): void
    {
        $session = $this->getSessionWithoutFreeTickets();
        $command = $this->createNewCommand($session->getId());

        $this->expectException(HandlerFailedException::class);
        $this->expectExceptionMessage('Билеты кончились');

        $this->bus->dispatch($command);
    }

    private function getSessionWithFreeTickets(): Session
    {
        $references = $this->databaseTool->loadFixtures([
            SessionWithFreeTicketsFixture::class,
        ])->getReferenceRepository();

        $session = $references->getReference(SessionWithFreeTicketsFixture::SESSION_WITH_FREE_TICKETS_REFERENCE);

        assert($session instanceof Session);

        return $session;
    }

    private function getSessionWithoutFreeTickets(): Session
    {
        $references = $this->databaseTool->loadFixtures([
            SessionWithoutFreeTicketsFixture::class,
        ])->getReferenceRepository();

        $session = $references->getReference(SessionWithoutFreeTicketsFixture::SESSION_WITHOUT_FREE_TICKETS_REFERENCE);

        assert($session instanceof Session);

        return $session;
    }

    private function createNewCommand(Uuid $sessionId): BookTicketCommand
    {
        return new BookTicketCommand($sessionId, 'testClient', '9876543210');
    }
}

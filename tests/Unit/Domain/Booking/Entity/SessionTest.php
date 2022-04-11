<?php

namespace App\Tests\Unit\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Hall;
use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\TransferObject\BookTicketDTO;
use App\Domain\Booking\Entity\TransferObject\BookTicketDTOFactory;
use App\Domain\Booking\Entity\ValueObject\Duration;
use App\Domain\Booking\Exception\TicketsAreOverException;
use App\Tests\Unit\UnitTestCase;
use DateTime;

final class SessionTest extends UnitTestCase
{
    public function testNewTicketExistsAfterBookTicketWhenSessionHasFreeTickets(): void
    {
        $client = $this->createClient();
        $session = $this->createSessionWithFreeTickets();

        $ticket = $session->bookTicket($client);

        $this->assertCount(1, $session->getTickets());
        $this->assertContains($ticket, $session->getTickets());
        $this->assertEquals($client->clientName, $ticket->getClient()->getClientName());
        $this->assertEquals($client->phoneNumber, $ticket->getClient()->getPhoneNumber()->getNumber());
    }

    public function testThrowExceptionAfterBookTicketWhenSessionHasNoFreeTickets(): void
    {
        $client = $this->createClient();
        $session = $this->createSessionWithoutFreeTickets();

        $this->expectException(TicketsAreOverException::class);

        $session->bookTicket($client);
    }

    private function createClient(): BookTicketDTO
    {
        return BookTicketDTOFactory::create('clientName', 'phoneNumber');
    }

    private function createSessionWithFreeTickets(): Session
    {
        return new Session(
            new Movie('TestMovie', new Duration(150)),
            new DateTime(),
            new Hall(5),
        );
    }

    private function createSessionWithoutFreeTickets(): Session
    {
        return new Session(
            new Movie('TestMovie', new Duration(150)),
            new DateTime(),
            new Hall(0),
        );
    }
}
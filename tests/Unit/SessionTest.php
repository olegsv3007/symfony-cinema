<?php

namespace App\Tests\Unit;

use App\Domain\Booking\Entity\Hall;
use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\TransferObject\BookTicketDTO;
use App\Domain\Booking\Entity\TransferObject\BookTicketDTOFactory;
use App\Domain\Booking\Entity\ValueObject\Duration;
use App\Domain\Booking\Exception\TicketsAreOverException;
use DateTime;
use PHPUnit\Framework\TestCase;

final class SessionTest extends TestCase
{
    public function testUserCanBookTicketWhenSessionHasFreeTickets(): void
    {
        $client = $this->getClient();
        $session = $this->getSessionWithFreeTickets();

        $ticket = $session->bookTicket($client);

        $this->assertCount(1, $session->getTickets());
        $this->assertContains($ticket, $session->getTickets());
        $this->assertEquals($client->clientName, $ticket->getClient()->getClientName());
        $this->assertEquals($client->phoneNumber, $ticket->getClient()->getPhoneNumber()->getNumber());
    }

    public function testUserCantBookTicketWhenSessionHasNoFreeTickets(): void
    {
        $client = $this->getClient();
        $session = $this->getSessionWithoutFreeTickets();
        $this->expectException(TicketsAreOverException::class);

        $session->bookTicket($client);
    }

    private function getClient(): BookTicketDTO
    {
        return BookTicketDTOFactory::create('clientName', 'phoneNumber');
    }

    private function getSessionWithFreeTickets(): Session
    {
        return new Session(
            new Movie('TestMovie', new Duration(150)),
            new DateTime(),
            new Hall(5),
        );
    }

    private function getSessionWithoutFreeTickets(): Session
    {
        return new Session(
            new Movie('TestMovie', new Duration(150)),
            new DateTime(),
            new Hall(0),
        );
    }
}

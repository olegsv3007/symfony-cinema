<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Collection\TicketCollection;
use App\Domain\Booking\Entity\TransferObject\BookTicketDTO;
use App\Domain\Booking\Entity\ValueObject\Client;
use App\Domain\Booking\Entity\ValueObject\PhoneNumber;
use App\Domain\Booking\Entity\ValueObject\SessionId;
use App\Domain\Booking\Entity\ValueObject\TicketId;
use App\Domain\Booking\Exception\TicketsAreOverException;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
final class Session
{
    private TicketCollection $bookedTickets;

    /** @ORM\Embedded(columnPrefix=false) */
    private SessionId $id;

    /** @ORM\ManyToOne() */
    private Movie $movie;

    /** @ORM\Column() */
    private DateTime $startAt;

    /** @ORM\ManyToOne() */
    private Hall $hall;

    public function __construct(
        SessionId $id,
        Movie $movie,
        DateTime $startAt,
        Hall $hall,
    ) {
        $this->id = $id;
        $this->movie = $movie;
        $this->startAt = $startAt;
        $this->hall = $hall;
        $this->bookedTickets = new TicketCollection();
    }

    public function getTickets(): TicketCollection
    {
        return $this->bookedTickets;
    }

    public function getId(): SessionId
    {
        return $this->id;
    }

    public function getMovie(): Movie
    {
        return $this->movie;
    }

    public function getStartAt(): DateTime
    {
        return $this->startAt;
    }

    public function getEndAt(): DateTime
    {
        return $this->startAt->add($this->movie->getDuration()->getDateInterval());
    }

    public function hasFreeTickets(): bool
    {
        return $this->getFreeTicketsQuantity() > 0;
    }

    public function getFreeTicketsQuantity(): int
    {
        return $this->hall->getTotalSeats() - $this->bookedTickets->count();
    }

    public function bookTicket(BookTicketDTO $ticketDTO): Ticket
    {
        if (!$this->hasFreeTickets()) {
            throw new TicketsAreOverException();
        }

        $client = new Client(
            $ticketDTO->clientName,
            new PhoneNumber($ticketDTO->phoneNumber),
        );

        $ticket = new Ticket(
            new TicketId(),
            $client,
            $this,
        );

        $this->bookedTickets->add($ticket);

        return $ticket;
    }
}

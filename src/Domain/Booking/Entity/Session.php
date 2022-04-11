<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\Collection\TicketCollection;
use App\Domain\Booking\Entity\TransferObject\BookTicketDTO;
use App\Domain\Booking\Entity\ValueObject\Client;
use App\Domain\Booking\Entity\ValueObject\PhoneNumber;
use App\Domain\Booking\Exception\TicketsAreOverException;
use App\Domain\Booking\Repository\DoctrineSessionRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity(repositoryClass=DoctrineSessionRepository::class)
 * @final
 */
class Session
{
    /**
     * @ORM\OneToMany (
     *     targetEntity="Ticket",
     *     mappedBy="session",
     *     cascade={"persist", "remove"},
     * )
     */
    private Collection $bookedTickets;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="doctrine.uuid_generator")
     */
    private Uuid $id;

    /** @ORM\ManyToOne(targetEntity="Movie", cascade={"persist", "remove"}) */
    private Movie $movie;

    /** @ORM\Column(type="datetime") */
    private DateTime $startAt;

    /**
     * @ORM\ManyToOne(targetEntity="Hall", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="hall_id", referencedColumnName="id")
     */
    private Hall $hall;

    public function __construct(
        Movie $movie,
        DateTime $startAt,
        Hall $hall,
    ) {
        $this->movie = $movie;
        $this->startAt = $startAt;
        $this->hall = $hall;
        $this->bookedTickets = new ArrayCollection();
    }

    public function getTickets(): TicketCollection
    {
        return new TicketCollection($this->bookedTickets->toArray());
    }

    public function getId(): ?Uuid
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
            $client,
            $this,
        );

        $this->bookedTickets->add($ticket);

        return $ticket;
    }
}

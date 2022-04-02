<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\ValueObject\Client;
use App\Domain\Booking\Entity\ValueObject\TicketId;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @final
 */
class Ticket
{
    /** @ORM\Embedded(columnPrefix=false) */
    private TicketId $id;

    /** @ORM\Embedded(columnPrefix=false) */
    private Client $client;

    /**
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="bookedTickets")
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id")
     */
    private Session $session;

    public function __construct(
        TicketId $id,
        Client $client,
        Session $session,
    ) {
        $this->id = $id;
        $this->client = $client;
        $this->session = $session;
    }

    public function getId(): TicketId
    {
        return $this->id;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getSession(): Session
    {
        return $this->session;
    }

    public function getStartAt(): DateTime
    {
        return $this->session->getStartAt();
    }
}

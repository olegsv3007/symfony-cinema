<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\ValueObject\Client;
use App\Domain\Booking\Entity\ValueObject\TicketId;
use DateTime;

class Ticket
{
    public function __construct(
        private TicketId $id,
        private Client $client,
        private Session $session,
    ) { }

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

    public function getDateTimeStart(): DateTime
    {
        return $this->session->getDateTimeStart();
    }
}

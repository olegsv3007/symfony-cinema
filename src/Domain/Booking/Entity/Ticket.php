<?php

namespace App\Domain\Booking\Entity;

use App\Domain\Booking\Entity\ValueObject\Client;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * @ORM\Entity()
 * @final
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="doctrine.uuid_generator")
     */
    private Uuid $id;

    /** @ORM\Embedded(columnPrefix=false) */
    private Client $client;

    /**
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="bookedTickets")
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id")
     */
    private Session $session;

    public function __construct(
        Client $client,
        Session $session,
    ) {
        $this->client = $client;
        $this->session = $session;
    }

    public function getId(): ?Uuid
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

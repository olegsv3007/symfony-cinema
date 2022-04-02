<?php

namespace App\Domain\Booking\Repository;

use App\Domain\Booking\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class TicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }

    public function add(Ticket $ticket, bool $flush = true): void
    {
        $this->_em->persist($ticket);

        if (!$flush) {
            return;
        }

        $this->_em->flush();
    }
}

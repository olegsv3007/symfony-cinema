<?php

namespace App\Domain\Booking\Repository;

use App\Domain\Booking\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class DoctrineSessionRepository extends ServiceEntityRepository implements SessionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function add(Session $session, bool $flush = true): void
    {
        $this->_em->persist($session);

        if (!$flush) {
            return;
        }

        $this->_em->flush();
    }

    public function findById(int $id): Session
    {
        return $this->find($id);
    }
}

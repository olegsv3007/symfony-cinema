<?php

namespace App\Domain\Booking\Repository;

use App\Domain\Booking\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

final class DoctrineSessionRepository extends ServiceEntityRepository implements SessionRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function save(Session $session): void
    {
        $this->_em->persist($session);
        $this->_em->flush();
    }

    public function findById(Uuid $id): Session
    {
        return $this->find($id);
    }
}

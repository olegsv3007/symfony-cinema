<?php

namespace App\Domain\Booking\Repository;

use App\Domain\Booking\Entity\Session;
use Symfony\Component\Uid\Uuid;

interface SessionRepository
{
    public function findById(Uuid $id): Session;

    public function save(Session $session): void;
}

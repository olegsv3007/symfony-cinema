<?php

namespace App\Domain\Booking\Repository;

use App\Domain\Booking\Entity\Session;

interface SessionRepository
{
    public function findById(int $id): Session;

    public function add(Session $session, bool $flush = true): void;
}

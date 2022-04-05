<?php

namespace App\Domain\Booking\Repository;

use App\Domain\Booking\Entity\Session;

interface SessionRepository
{
    public function findById(int $id): Session;

    public function save(Session $session): void;
}

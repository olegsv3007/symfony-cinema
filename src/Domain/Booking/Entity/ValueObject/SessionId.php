<?php

namespace App\Domain\Booking\Entity\ValueObject;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable() */
final class SessionId extends AbstractId
{
}

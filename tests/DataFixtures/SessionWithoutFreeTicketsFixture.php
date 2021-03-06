<?php

namespace App\Tests\DataFixtures;

use App\Domain\Booking\Entity\Hall;
use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\ValueObject\Duration;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class SessionWithoutFreeTicketsFixture extends Fixture
{
    public const SESSION_WITHOUT_FREE_TICKETS_REFERENCE = 'session-without-free-tickets';

    public function load(ObjectManager $manager): void
    {
        $hall = new Hall(0);
        $movie = new Movie('Movie #1', new Duration(116));
        $session = new Session($movie, new DateTime('tomorrow'), $hall);

        $manager->persist($session);
        $manager->flush();

        $this->addReference(self::SESSION_WITHOUT_FREE_TICKETS_REFERENCE, $session);
    }
}

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
    public function load(ObjectManager $manager): void
    {
        $hall1 = new Hall(0);
        $movie1 = new Movie('Movie #1', new Duration(116));
        $session1 = new Session($movie1, new DateTime('tomorrow'), $hall1);

        $manager->persist($hall1);
        $manager->persist($movie1);
        $manager->persist($session1);

        $manager->flush();
    }
}

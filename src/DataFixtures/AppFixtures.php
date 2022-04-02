<?php

namespace App\DataFixtures;

use App\Domain\Booking\Entity\Hall;
use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\Ticket;
use App\Domain\Booking\Entity\ValueObject\Client;
use App\Domain\Booking\Entity\ValueObject\Duration;
use App\Domain\Booking\Entity\ValueObject\HallId;
use App\Domain\Booking\Entity\ValueObject\MovieId;
use App\Domain\Booking\Entity\ValueObject\PhoneNumber;
use App\Domain\Booking\Entity\ValueObject\SessionId;
use App\Domain\Booking\Entity\ValueObject\TicketId;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $halls = [];

        for ($i = 1; $i < 4; $i++) {
            $hall = new Hall(new HallId(), 35 * $i);
            $manager->persist($hall);
            $halls[] = $hall;
        }

        $movies = [];

        for ($i = 1; $i < 4; $i++) {
            $movie = new Movie(new MovieId(), sprintf('Movie #%d', $i), new Duration($i * 21));
            $manager->persist($movie);
            $movies[] = $movie;
        }

        $sessions = [];

        for ($i = 1; $i < 4; $i++) {
            $movieKey = array_rand($movies);
            $hallKey = array_rand($halls);
            $session = new Session(new SessionId(), $movies[$movieKey], new DateTime(), $halls[$hallKey]);
            $manager->persist($session);
            $sessions[] = $session;
        }

        $tickets = [];

        for ($i = 1; $i < 30; $i++) {
            $sessionKey = array_rand($sessions);
            $client = new Client(sprintf('Client %d', $i), new PhoneNumber(sprintf('79876543%d', $i)));
            $ticket = new Ticket(new TicketId(), $client, $sessions[$sessionKey]);
            $manager->persist($ticket);
            $tickets[] = $ticket;
        }

        $manager->flush();
    }
}

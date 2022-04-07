<?php

namespace App\DataFixtures;

use App\Domain\Booking\Entity\Hall;
use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\Ticket;
use App\Domain\Booking\Entity\ValueObject\Client;
use App\Domain\Booking\Entity\ValueObject\Duration;
use App\Domain\Booking\Entity\ValueObject\PhoneNumber;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $hall1 = new Hall(10);
        $hall2 = new Hall(15);
        $hall3 = new Hall(20);

        $manager->persist($hall1);
        $manager->persist($hall2);
        $manager->persist($hall3);

        $movie1 = new Movie('Movie #1', new Duration(116));
        $movie2 = new Movie('Movie #2', new Duration(138));
        $movie3 = new Movie('Movie #3', new Duration(152));

        $manager->persist($movie1);
        $manager->persist($movie2);
        $manager->persist($movie3);

        $session1 = new Session($movie1, new DateTime('tomorrow'), $hall1);
        $session2 = new Session($movie2, new DateTime('tomorrow'), $hall2);
        $session3 = new Session($movie3, new DateTime('tomorrow'), $hall3);

        $manager->persist($session1);
        $manager->persist($session2);
        $manager->persist($session3);

        $client = new Client('TestClient', new PhoneNumber('9876543210'));

        for ($i = 0; $i < 10; $i++) {
            $ticket = new Ticket($client, $session1);
            $manager->persist($ticket);
        }

        for ($i = 0; $i < 10; $i++) {
            $ticket = new Ticket($client, $session2);
            $manager->persist($ticket);
        }

        for ($i = 0; $i < 10; $i++) {
            $ticket = new Ticket($client, $session3);
            $manager->persist($ticket);
        }

        $manager->flush();
    }
}

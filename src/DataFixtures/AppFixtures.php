<?php

namespace App\DataFixtures;

use App\Domain\Booking\Entity\Hall;
use App\Domain\Booking\Entity\Movie;
use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Entity\ValueObject\Duration;
use App\Domain\Booking\Entity\ValueObject\HallId;
use App\Domain\Booking\Entity\ValueObject\MovieId;
use App\Domain\Booking\Entity\ValueObject\SessionId;
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
            $movie_key = array_rand($movies);
            $hall_key = array_rand($halls);
            $session = new Session(new SessionId(), $movies[$movie_key], new DateTime(), $halls[$hall_key]);
            $manager->persist($session);
            $sessions[] = $session;
        }

        $manager->flush();
    }
}

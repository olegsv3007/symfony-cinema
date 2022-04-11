<?php

namespace App\Tests\Functional;

use App\Domain\Booking\Entity\Session;
use App\Domain\Booking\Repository\SessionRepository;
use App\Tests\DataFixtures\SessionWithFreeTicketsFixture;
use App\Tests\DataFixtures\SessionWithoutFreeTicketsFixture;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class FunctionalTestCase extends KernelTestCase
{
    protected SessionRepository $sessionRepository;
    protected MessageBusInterface $bus;
    protected AbstractDatabaseTool $databaseTool;
    protected ValidatorInterface $validator;

    protected function setUp(): void
    {
        self::bootKernel();

        $container = self::getContainer();

        $this->sessionRepository = $container->get(SessionRepository::class);
        $this->bus = $container->get(MessageBusInterface::class);
        $this->databaseTool = $container->get(DatabaseToolCollection::class)->get();
        $this->validator = $container->get(ValidatorInterface::class);
    }

    protected function getSessionWithFreeTickets(): Session
    {
        $this->databaseTool->loadFixtures([
            SessionWithFreeTicketsFixture::class,
        ]);

        return $this->sessionRepository->findAll()[0];
    }

    protected function getSessionWithoutFreeTickets(): Session
    {
        $this->databaseTool->loadFixtures([
            SessionWithoutFreeTicketsFixture::class,
        ]);

        return $this->sessionRepository->findAll()[0];
    }
}

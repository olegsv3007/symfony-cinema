<?php

namespace App\Tests\Functional;

use App\Domain\Booking\Repository\SessionRepository;
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
}

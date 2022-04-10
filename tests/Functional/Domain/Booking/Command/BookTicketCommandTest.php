<?php

namespace App\Tests\Functional\Domain\Booking\Command;

use App\Domain\Booking\Command\BookTicketCommand;
use App\Domain\Booking\Entity\Session;
use App\Tests\DataFixtures\SessionWithFreeTicketsFixture;
use App\Tests\DataFixtures\SessionWithoutFreeTicketsFixture;
use App\Tests\Functional\FunctionalKernelTestCase;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Uid\Uuid;

final class BookTicketCommandTest extends FunctionalKernelTestCase
{
    /**
     * @dataProvider validClientDataProvider
     */
    public function testCorrectCommandCanBeHandleForSessionWithFreeTickets(string $clientName, string $phoneNumber): void
    {
        $session = $this->getSessionWithFreeTickets();
        $command = $this->getNewCommand($session->getId(), $clientName, $phoneNumber);

        $this->bus->dispatch($command);

        $this->assertEquals(1, $session->getTickets()->count());
    }

    public function testCorrectCommandThrowExceptionForSessionWithoutFreeTickets(): void
    {
        $session = $this->getSessionWithoutFreeTickets();
        $command = $this->getNewCommand($session->getId());
        $this->expectException(HandlerFailedException::class);
        $this->expectExceptionMessage('Билеты кончились');

        $this->bus->dispatch($command);

        $this->assertEquals(10, $session->getTickets()->count());
    }

    /**
     * @dataProvider invalidClientDataProvider
     */
    public function testCommandWithInvalidClientDataThrowValidationException(
        string $clientName,
        string $phoneNumber,
    ): void {
        $session = $this->getSessionWithFreeTickets();
        $command = $this->getNewCommand($session->getId(), $clientName, $phoneNumber);
        $this->expectException(ValidationFailedException::class);

        $this->bus->dispatch($command);
    }

    private function getNewCommand(
        Uuid $sessionId,
        string $clientName = 'testClient',
        string $phoneNumber = '9876543210',
    ): BookTicketCommand {
        $command = new BookTicketCommand();

        $command->sessionId = $sessionId;
        $command->clientName = $clientName;
        $command->phoneNumber = $phoneNumber;

        return $command;
    }

    private function getSessionWithFreeTickets(): Session
    {
        $this->databaseTool->loadFixtures([
            SessionWithFreeTicketsFixture::class,
        ]);

        return $this->sessionRepository->findAll()[0];
    }

    private function getSessionWithoutFreeTickets(): Session
    {
        $this->databaseTool->loadFixtures([
            SessionWithoutFreeTicketsFixture::class,
        ]);

        return $this->sessionRepository->findAll()[0];
    }

    /**
     * @return array<array<string, string>>
     */
    private function invalidClientDataProvider(): array
    {
        return [
            'empty_client_name' => ['', '9876543210'],
            'empty_phone_number' => ['testClient', ''],
            'short_phone_number' => ['testClient', '12345678'],
            'long_phone_number' => ['testClient', '123456789012345'],
            'all_empty' => ['', ''],
        ];
    }

    /**
     * @return array<array<string, string>>
     */
    private function validClientDataProvider(): array
    {
        return [
            ['t', '9876543210'],
            ['f', '123456789'],
            ['dfhgdfhsdhsdhsdghsdgh', '12345678901234'],
            ['FfFDf FFGfe$D', '12345678901234'],
        ];
    }
}

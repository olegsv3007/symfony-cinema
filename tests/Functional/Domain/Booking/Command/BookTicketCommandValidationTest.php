<?php

namespace App\Tests\Functional\Domain\Booking\Command;

use App\Domain\Booking\Command\BookTicketCommand;
use App\Tests\Functional\FunctionalKernelTestCase;

final class BookTicketCommandValidationTest extends FunctionalKernelTestCase
{
    /**
     * @dataProvider validClientDataProvider
     */
    public function testBookTicketCommandWithValidDataValidateWithoutErrors(
        string $clientName,
        string $phoneNumber,
    ): void {
        $session = $this->getSessionWithFreeTickets();
        $command = new BookTicketCommand($session->getId(), $clientName, $phoneNumber);

        $violationList = $this->validator->validate($command);

        $this->assertCount(0, $violationList);
    }

    /**
     * @dataProvider invalidClientDataProvider
     */
    public function testBookTicketCommandWithInvalidDataValidateWithErrors(
        string $clientName,
        string $phoneNumber,
    ): void {
        $session = $this->getSessionWithFreeTickets();
        $command = new BookTicketCommand($session->getId(), $clientName, $phoneNumber);

        $violationList = $this->validator->validate($command);

        $this->assertGreaterThan(0, $violationList->count());
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

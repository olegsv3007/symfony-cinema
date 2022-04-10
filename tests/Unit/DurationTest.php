<?php

namespace App\Tests\Unit;

use App\Domain\Booking\Entity\ValueObject\Duration;
use InvalidArgumentException;

final class DurationTest extends UnitTestCase
{
    /**
     * @dataProvider negativeNumbersProvider
     */
    public function testDurationCantBeNegative(int $totalMinutes): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Duration($totalMinutes);
    }

    /**
     * @dataProvider calculateHoursProvider
     */
    public function testDurationCalculateHoursRight(int $totalMinutes, int $exceptedHours): void
    {
        $duration = new Duration($totalMinutes);

        $hours = $duration->getHours();

        $this->assertEquals($exceptedHours, $hours);
    }

    /**
     * @dataProvider calculateMinutesProvider
     */
    public function testDurationCalculateMinutesRight(int $totalMinutes, int $exceptedMinutes): void
    {
        $duration = new Duration($totalMinutes);

        $minutes = $duration->getMinutes();

        $this->assertEquals($exceptedMinutes, $minutes);
    }

    /**
     * @return array<array<int>>
     */
    private function calculateMinutesProvider(): array
    {
        return [
            [0, 0],
            [1, 1],
            [30, 30],
            [59, 59],
            [60, 0],
            [61, 1],
            [119, 59],
            [158, 38],
            [600, 0],
        ];
    }

    /**
     * @return array<array<int>>
     */
    private function calculateHoursProvider(): array
    {
        return [
            [0, 0],
            [1, 0],
            [30, 0],
            [59, 0],
            [60, 1],
            [61, 1],
            [100, 1],
            [150, 2],
            [600, 10],
        ];
    }

    /**
     * @return array<array<int>>
     */
    private function negativeNumbersProvider(): array
    {
        return [
            [-1],
            [-5],
            [-10_000_000],
        ];
    }
}

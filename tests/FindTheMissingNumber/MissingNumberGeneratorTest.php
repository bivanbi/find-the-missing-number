<?php

namespace KignOrg\FindTheMissingNumber;

use PHPUnit\Framework\TestCase;

class MissingNumberGeneratorTest extends TestCase
{
    private array $maximums = [1023, 2048, 4095, 2**13, 2**16];
    private MissingNumberGenerator $generator;
    private StopWatch $stopWatch;

    private string $execTimeFormatString = "[%' 7.3f ms] %' 35s (max: %' 7d, CPU efficiency: %' 3.3f numbers / us)\n";

    protected function setUp(): void
    {
        $this->generator = new MissingNumberGeneratorImpl();
        $this->stopWatch = new StopWatch();
    }

    public function testGenerateInAscendingOrder()
    {
        foreach ($this->maximums as $maximum) {
            $expectedMissing = rand(1, $maximum);
            $this->stopWatch->reset();
            $actualNumbers = $this->generator->generateInAscendingOrder($maximum, $expectedMissing);
            $this->printExecutionTime(__FUNCTION__, $maximum, $this->stopWatch->getElapsedTimeMilliSecondsFloat());
            $this->assertAllNumberButMissingPresent($maximum, $expectedMissing, $actualNumbers);
            self::assertTrue($this->isInAscendingOrder($actualNumbers), "Expect that numbers are in ascending order");
        }
    }

    public function testGenerateInRandomOrder()
    {
        foreach ($this->maximums as $maximum) {
            $expectedMissing = rand(1, $maximum);
            $this->stopWatch->reset();
            $actualNumbers = $this->generator->generateInRandomOrder($maximum, $expectedMissing);
            $this->printExecutionTime(__FUNCTION__, $maximum, $this->stopWatch->getElapsedTimeMilliSecondsFloat());
            $this->assertAllNumberButMissingPresent($maximum, $expectedMissing, $actualNumbers);
            self::assertFalse($this->isInAscendingOrder($actualNumbers), 'Expect that numbers are NOT in ascending order');
        }
    }

    private function printExecutionTime(string $caller, int $maximum, float $elapsedTime): void
    {
        printf($this->execTimeFormatString, $elapsedTime, $caller, $maximum, ($maximum / $elapsedTime / 1000));
    }

    private function assertAllNumberButMissingPresent(int $expectedMaximum, int $expectedMissing, array $actualNumbers): void
    {
        self::assertEquals($expectedMaximum - 1, sizeof($actualNumbers), "Expect an array of size $expectedMaximum - 1");
        self::assertFalse(in_array($expectedMissing, $actualNumbers), "Expect that $expectedMissing is actually missing");

        for ($i = 1; $i <= sizeof($actualNumbers) + 1; $i++) {
            self::assertTrue($i === $expectedMissing || in_array($i, $actualNumbers),
                'expect all numbers present in the array except for the one that is deliberately missing');
        }
    }

    private function isInAscendingOrder(array $actualNumbers): bool
    {
        for ($i = 1; $i < sizeof($actualNumbers); $i++) {
            if ($actualNumbers[$i-1] > $actualNumbers[$i]) {
                return false;
            }
        }

        return true;
    }
}

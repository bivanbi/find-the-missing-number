<?php

namespace KignOrg\FindTheMissingNumber;

use PHPUnit\Framework\TestCase;

class MissingNumberFinderTest extends TestCase
{
    private array $maximums = [1023, 2048, 4095, 8192, 16383, 32768, 64535];
    private MissingNumberGenerator $missingNumberGenerator;
    private StopWatch $stopWatch;
    private string $execTimeFormatString = "%s: finding the missing number out of %d numbers took %f microseconds\n";

    /*
     * TODO
     *  - implement various algorithms to find the missing number in a random ordered array of unique numbers
     *  - Do each implementation in different classes that implement MissingNumberFinder interface.
     *  - Determine the CPU efficiency of each algorithm and chose the fastest.
     *
     * TODO for bonus:
     *  - determine the memory efficiency of each algorithm and answer these questions:
     *  - which algorithm is the most memory efficient? (you may have to increase $maximums to get a decent measurement)
     *  - is there a 'best' algorithm that is both memory and CPU efficient?
     *  - is there an algorithm, that has good CPU efficiency in expense of bad memory efficiency and vice versa?
     */
    protected function setUp(): void
    {
        $this->missingNumberGenerator = new MissingNumberGeneratorImpl();
        $this->stopWatch = new StopWatch();
    }

    public function testExampleImplementation()
    {
        foreach($this->maximums as $maximumNumber) {
            $expectedMissingNumber = rand(1, $maximumNumber);
            $haystack = $this->missingNumberGenerator->generateInRandomOrder($maximumNumber, $expectedMissingNumber);
            $finder = new MissingNumberFinderExampleImpl();
            $this->stopWatch->reset();
            $actualMissingNumber = $finder->find($haystack);
            $this->printExecutionTime(__FUNCTION__, $maximumNumber, $this->stopWatch->getElapsedTimeNanoseconds());
            self::assertEquals($expectedMissingNumber, $actualMissingNumber, "Expected missing number equals actual missing number");
        }
    }

    // TODO public function testOtherImplementation(){ ... }
    // TODO public function testAnotherImplementation(){ ... }

    // TODO for bonus: - practice DRY (DoNotRepeatYourself) principle when creating the test methods

    private function printExecutionTime(string $caller, int $maximum, int $elapsedTime): void
    {
        printf($this->execTimeFormatString, $caller, $maximum, floatval($elapsedTime / 1000000), $elapsedTime);
    }
}

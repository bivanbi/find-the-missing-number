<?php

namespace KignOrg\FindTheMissingNumber;

use PHPUnit\Framework\TestCase;

class MissingNumberFinderTest extends TestCase
{
    private array $maximums = [1023, 16383, 64535, 2 ** 18, 2 ** 20];
    private MissingNumberGenerator $missingNumberGenerator;
    private StopWatch $stopWatch;
    private string $execTimeFormatString = "[%' 7.3f ms] %' 60s (max: %' 7d, CPU efficiency: %' 7.3f numbers / us)\n";

    protected function setUp(): void
    {
        $this->missingNumberGenerator = new MissingNumberGeneratorImpl();
        $this->stopWatch = new StopWatch();
    }

    public function testArraySumFinder_withFirstNumberMissing()
    {
        $finder = new ArraySumMissingNumberFinder();
        foreach ($this->maximums as $maximumNumber) {
            $this->testFind(__FUNCTION__, $finder, $maximumNumber, 1);
        }
    }

    public function testArraySumFinder_withRandomNumberMissing()
    {
        $finder = new ArraySumMissingNumberFinder();
        foreach ($this->maximums as $maximumNumber) {
            $this->testFind(__FUNCTION__, $finder, $maximumNumber, rand(1, $maximumNumber));
        }
    }

    public function testArraySumFinder_withLastNumberMissing()
    {
        $finder = new ArraySumMissingNumberFinder();
        foreach ($this->maximums as $maximumNumber) {
            $this->testFind(__FUNCTION__, $finder, $maximumNumber, $maximumNumber);
        }
    }

    public function testArraySort()
    {
        foreach ($this->maximums as $maximumNumber) {
            $array = $this->missingNumberGenerator->generateInRandomOrder($maximumNumber, rand(1, $maximumNumber));
            $this->stopWatch->reset();
            sort($array);
            $elapsedTime = $this->stopWatch->getElapsedTimeMilliSecondsFloat();
            printf($this->execTimeFormatString, $elapsedTime, __FUNCTION__, $maximumNumber, ($maximumNumber / $elapsedTime / 1000));
            self::assertTrue(true);
        }
    }

    public function testIterateSortedElementsFinder_withFirstNumberMissing()
    {
        $finder = new IterateSortedElementsMissingNumberFinder();
        foreach ($this->maximums as $maximumNumber) {
            $this->testFind(__FUNCTION__, $finder, $maximumNumber, 1);
        }
    }

    public function testIterateSortedElementsFinder_withRandomNumberMissing()
    {
        $finder = new IterateSortedElementsMissingNumberFinder();
        foreach ($this->maximums as $maximumNumber) {
            $this->testFind(__FUNCTION__, $finder, $maximumNumber, rand(1, $maximumNumber));
        }
    }

    public function testIterateSortedElementsFinder_withLastNumberMissing()
    {
        $finder = new IterateSortedElementsMissingNumberFinder();
        foreach ($this->maximums as $maximumNumber) {
            $this->testFind(__FUNCTION__, $finder, $maximumNumber, $maximumNumber);
        }
    }

    public function testAddAndSubtractFinder_withFirstNumberMissing()
    {
        $finder = new AddAndSubtractMissingNumberFinder();
        foreach ($this->maximums as $maximumNumber) {
            $this->testFind(__FUNCTION__, $finder, $maximumNumber, 1);
        }
    }

    public function testAddAndSubtractFinder_withRandomNumberMissing()
    {
        $finder = new AddAndSubtractMissingNumberFinder();
        foreach ($this->maximums as $maximumNumber) {
            $this->testFind(__FUNCTION__, $finder, $maximumNumber, rand(1, $maximumNumber));
        }
    }

    public function testAddAndSubtractFinder_withLastNumberMissing()
    {
        $finder = new AddAndSubtractMissingNumberFinder();
        foreach ($this->maximums as $maximumNumber) {
            $this->testFind(__FUNCTION__, $finder, $maximumNumber, $maximumNumber);
        }
    }

    public function testHalveSortedArrayFinder_withFirstNumberMissing()
    {
        $finder = new HalveSortedArrayMissingNumberFinder();
        foreach ($this->maximums as $maximumNumber) {
            $this->testFind(__FUNCTION__, $finder, $maximumNumber, 1);
        }
    }

    public function testHalveSortedArrayFinder_withLastNumberMissing()
    {
        $finder = new HalveSortedArrayMissingNumberFinder();
        foreach ($this->maximums as $maximumNumber) {
            $this->testFind(__FUNCTION__, $finder, $maximumNumber, $maximumNumber);
        }
    }

    public function testHalveSortedArrayFinder_withRandomNumberMissing()
    {
        $finder = new HalveSortedArrayMissingNumberFinder();
        foreach ($this->maximums as $maximumNumber) {
            $this->testFind(__FUNCTION__, $finder, $maximumNumber, rand(1, $maximumNumber));
        }
    }


    private function testFind(string $caller, MissingNumberFinder $finder, int $maximumNumber, int $expectedMissingNumber)
    {
        $haystack = $this->missingNumberGenerator->generateInRandomOrder($maximumNumber, $expectedMissingNumber);
        $this->stopWatch->reset();
        $actualMissingNumber = $finder->find($haystack);
        $this->printExecutionTime($caller, $maximumNumber, $this->stopWatch->getElapsedTimeMilliSecondsFloat());
        self::assertEquals($expectedMissingNumber, $actualMissingNumber, 'Expected missing number equals actual missing number');
    }

    private function printExecutionTime(string $caller, int $maximum, float $elapsedTime): void
    {
        printf($this->execTimeFormatString, $elapsedTime, $caller, $maximum, ($maximum / $elapsedTime / 1000));
    }
}

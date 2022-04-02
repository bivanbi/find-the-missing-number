<?php

namespace KignOrg\FindTheMissingNumber;

class StopWatch
{
    private int $startTimeNanoseconds;

    public function __construct()
    {
        $this->reset();
    }

    public function reset()
    {
        $this->startTimeNanoseconds = hrtime(true);
    }

    public function getElapsedTimeMilliSecondsFloat(): float
    {
        return floatval($this->getElapsedTimeNanoseconds() / 1000000);
    }

    public function getElapsedTimeNanoseconds(): int
    {
        return hrtime(true) - $this->startTimeNanoseconds;
    }
}

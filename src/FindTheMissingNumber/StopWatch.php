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

    public function getElapsedTimeNanoseconds(): int
    {
        return hrtime(true) - $this->startTimeNanoseconds;
    }
}

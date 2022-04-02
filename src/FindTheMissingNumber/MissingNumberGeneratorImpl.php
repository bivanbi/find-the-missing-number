<?php

namespace KignOrg\FindTheMissingNumber;

class MissingNumberGeneratorImpl implements MissingNumberGenerator
{

    public function generateInRandomOrder(int $maximum, int $missing = null): array
    {
        $result = $this->generateInAscendingOrder($maximum, $missing);
        shuffle($result);
        return $result;
    }

    public function generateInAscendingOrder(int $maximum, int $missing = null): array
    {
        $array = range(1, $maximum);
        array_splice($array, $missing - 1, 1);
        return $array;
    }
}

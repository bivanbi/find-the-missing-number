<?php

namespace KignOrg\FindTheMissingNumber;

class ArraySumMissingNumberFinder implements MissingNumberFinder
{
    public function find(array $numbers): int
    {
        $maximum = sizeof($numbers) + 1;
        $sum = ($maximum**2 + $maximum) / 2;
        return ($sum - array_sum($numbers));
    }
}

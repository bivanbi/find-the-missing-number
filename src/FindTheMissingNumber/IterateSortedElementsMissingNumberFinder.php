<?php

namespace KignOrg\FindTheMissingNumber;

class IterateSortedElementsMissingNumberFinder implements MissingNumberFinder
{
    public function find(array $numbers): int
    {
        sort($numbers);
        for ($i = 0; $i < sizeof($numbers); $i++) {
            if ($numbers[$i] !== $i + 1) {
                return $i + 1;
            }
        }
        return sizeof($numbers) + 1;
    }
}

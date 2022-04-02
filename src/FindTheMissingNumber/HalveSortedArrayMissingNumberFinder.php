<?php

namespace KignOrg\FindTheMissingNumber;

class HalveSortedArrayMissingNumberFinder implements MissingNumberFinder
{
    public function find(array $numbers): int
    {
        sort($numbers);
        $numbers[] = 0; // in case last number is missing, 'pretend' that it is there
        $lowBoundary = 0;
        $highBoundary = sizeof($numbers) - 1;

        do {
            $middle = intval(($lowBoundary + $highBoundary) / 2);
            if ($numbers[$middle] === $middle + 1) {
                $lowBoundary = $middle + 1;
            } else {
                $highBoundary = $middle;
            }
            $middle = intval(($lowBoundary + $highBoundary) / 2);
        } while ($lowBoundary < $highBoundary);
        return $middle + 1;
    }
}

<?php

namespace KignOrg\FindTheMissingNumber;

class AddAndSubtractMissingNumberFinder implements MissingNumberFinder
{
    public function find(array $numbers): int
    {
        $difference = 0;
        for($index = 0; $index < sizeof($numbers); $index++) {
            $difference += $index - $numbers[$index] + 1;
        }
        return $difference + sizeof($numbers) + 1;
    }
}

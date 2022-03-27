<?php

namespace KignOrg\FindTheMissingNumber;

interface MissingNumberFinder
{
    /**
     * Method to find which number is missing from an array that contains all unique positive integers ranging
     * from 1 to array size, except for that single missing number.
     *
     * example:
     *  [1, 4, 3 ] -> 2 is missing
     *  [3, 6, 5, 2, 1] -> 4 is missing
     *
     * @param array $numbers
     * @return int
     */
    public function find(array $numbers): int;
}

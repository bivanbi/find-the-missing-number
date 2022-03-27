<?php

namespace KignOrg\FindTheMissingNumber;

interface MissingNumberGenerator
{
    /**
     * Method to generate a series of unique positive integer numbers ranging from 1 to $maximum in one increments,
     * but with one number missing. The numbers will be in random order.
     *
     * example:
     *  generate(4, 2) result: [3, 4, 1] -> 2 is missing
     *  generate(6, 4) result: [2, 6, 1, 5, 3] -> 4 is missing
     *
     */
    public function generateInRandomOrder(int $maximum, int $missing = null): array;

    /**
     * Method to generate a series of unique positive integer numbers ranging from 1 to array size in one increments,
     * but with one number missing. The numbers will be in ascending order.
     *
     * example:
     *  generate(4, 2) result: [1, 3, 4] -> 2 is missing
     *  generate(6, 4) result: [1, 2, 3, 5, 6] -> 4 is missing
     *
     * @param int $maximum
     * @param int|null $missing if not specified, a random number will be chosen between 1 and $maximum (inclusive)
     * @return int[] array of integers with one number missing from the series
     */
    public function generateInAscendingOrder(int $maximum, int $missing = null): array;
}

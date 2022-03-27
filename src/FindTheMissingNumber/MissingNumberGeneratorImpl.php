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
        $missing = $missing ?? rand(1, $maximum);
        $result = [];
        for ($i = 1; $i <= $maximum; $i++) {
            if ($i !== $missing) {
                $result[] = $i;
            }
        }
        return $result;
    }
}

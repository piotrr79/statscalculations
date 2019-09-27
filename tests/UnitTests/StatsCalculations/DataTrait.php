<?php

namespace App\Tests\UnitTests\StatsCalculations;

/**
 * DataTrait - test payload
 */
trait DataTrait
{
    /**
     * Test data for even array
     * @return array
     */
    private function dataEvenArray()
    {
        $data = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8];

        return $data;
    }

    /**
     * Test data for odd array
     * @return array
     */
    private function dataOddArray()
    {
        $data = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9];

        return $data;
    }
}

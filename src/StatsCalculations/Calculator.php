<?php
declare(strict_types=1);

namespace App\StatsCalculations;

/**
 * Calculator - basic maths calculations
 * @ToDo - Nice to have UnitTests for this class
 */
class Calculator
{
    /**
     * Get max value of array
     * @param array $array
     * @return string
     */
    public function max($array)
    {
        return max($array);
    }

    /**
     * Get min value of array
     * @param array $array
     * @return string
     */
    public function min($array)
    {
        return min($array);
    }

    /**
     * Calculate mean value of array
     * @param array $array
     * @return string
     */
    public function mean($array)
    {
        $array = array_filter($array);

        return  array_sum($array)/count($array);
    }

    /**
     * Calculate median value of array
     * @param array $array
     * @return string
     * @ToDo - Write more UnitTest to make sure median is callculated correctly
     * @ToDo - Improve median calculations
     */
    public function median($array)
    {
        asort($array, SORT_NUMERIC);
        $middle = round(count($array), 2);

        return  $array[$middle-1];
    }

    /**
     * Find under-performing array elements
     * @param array $array
     * @return $array
     * @ToDo - Improve under performacne calculations, it seems they needs more complex pattern than only simple mean
     * @ToDo - not enough information in tests asserts to figure out how it should be computed
     */
    public function underPerformance ($array, $mean) {
        $uperforming = [];
        foreach ($array as $item) {
            if ($item['metricValue'] < $mean) {
                $uperforming[] = $item['dtime'];
            }
        }
        return $uperforming;
    }
}

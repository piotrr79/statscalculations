<?php
declare(strict_types=1);

namespace App\Validators;

/**
 * Calculator - basic maths calculations
 */
class ResponseSetter
{
    /**
     * Get max value of array
     * @param array $array
     * @return string
     */
    public function setResponse($min, $max, $mean, $median, $fromdate, $todate, $uperforming = null)
    {

        $output = 'SamKnows Metric Analyser v1.0.0
        ===============================

        Period checked:

        From: '.$fromdate.'
        To:   '.$todate.'

        Statistics:

        Unit: Megabits per second

        Average: '.$min.'
        Min: '.$max.'
        Max: '.$mean.'
        Median: '.$median
        ;

        return $output;
    }
}

<?php
declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use App\Validators\ValidationConstraints;
use App\Validators\DataValidator;
use App\StatsCalculations\Calculator;
use App\Validators\ResponseSetter;

/**
 * StatisticsController - generate caclulations.
 * Code puts DataLayer, Validation, Calculator and Response together (MVC alike pattern)
 */
class StatisticsController extends AbstractController
{
    /** @var \Psr\Log\LoggerInterface  */
    private $logger;
    /** @var \App\StatsCalculations\Calculator */
    private $calculator;
    /** @var \App\Validators\ValidationConstraints */
    private $validationConstraints;
    /** @var \App\Validators\DataValidator */
    private $dataValidator;
    /** @var \App\Validators\ResponseSetter */
    private $responseSetter;

    public function __construct(LoggerInterface $logger)
    {
        $this->calculator = new Calculator();
        $this->validationConstraints = new ValidationConstraints();
        $this->dataValidator = new DataValidator($logger);
        $this->responseSetter = new ResponseSetter();
    }

    /**
     * Min max
     * @param array $data
     * @return array
     */
    public function analyzer($data)
    {
        /** @Todo - move data validation to separate class, e.g. App\Validators\RequestValidator */
        $metrics = array_column($data['data'][0]['metricData'], 'metricValue');
        $dates = array_column($data['data'][0]['metricData'], 'dtime');
        $filteredArray = $data['data'][0]['metricData'];

        // Validate data against required array keys
        $constraints = $this->validationConstraints->dataConstraints();
        $this->dataValidator->checkArrayKeys($filteredArray, $constraints);

        // Run calculations
        $min = $this->calculator->min($metrics);
        $max = $this->calculator->max($metrics);
        $mean = $this->calculator->mean($metrics);
        /** @Todo - Write UnitTest to make sure median is callculated correctly */
        $median = $this->calculator->median($metrics);
        $fromdate = $this->calculator->min($dates);
        $todate = $this->calculator->max($dates);
        /** @Todo - improve under-performance calucaltions. Not it is simple 'below mean' */
        $uperforming =  $this->calculator->underPerformance($filteredArray, $mean);

        /**
         * @Todo - improve units recalculation, tests results in data json does not look like  Megabytes,
         * nor Megabits, nor Bits
         * @Todo - handle uperforming since it does not appear in both asserts (must be the conditional response in response)
         */
        $response = $this->responseSetter->setResponse($min, $max, $mean, $median, $fromdate, $todate, $uperforming);

        return $response;
    }
}

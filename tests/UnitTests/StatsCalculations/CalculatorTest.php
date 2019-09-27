<?php
declare(strict_types=1);

namespace App\Tests\UnitTests\StatsCalculations;

use PHPUnit\Framework\TestCase;
use App\Tests\UnitTests\StatsCalculations\DataTrait;
use App\StatsCalculations\Calculator;

/**
 * CalculatorTest - test msth calculations
 * @internal - to be run with `./vendor/bin/simple-phpunit  --debug`
 */
class CalculatorTest extends TestCase
{
    use DataTrait;

    /**
     * Test median calculation
     * @internal Excpected result should be like $expected array
     */
    public function testMedianEven()
    {
        $calculator = new Calculator();
        $result = $calculator->median($this->dataEvenArray());
        $this->assertEquals(7, $result);
    }

    /**
     * Test median calculation
     * @internal Excpected result should be like $expected array
     */
    public function testMedianOdd()
    {
        $calculator = new Calculator();
        $result = $calculator->median($this->dataOddArray());
        $this->assertEquals(8, $result);
    }
}

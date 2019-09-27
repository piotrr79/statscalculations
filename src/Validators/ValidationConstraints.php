<?php
declare(strict_types=1);

namespace App\Validators;

/**
 * ValidationConstraints - checks for required array keys
 */
class ValidationConstraints
{
    /**
     * Data array constraints - minimal validation, checks if data contains metricValue and dtime
     * @return array
     */
    public function dataConstraints()
    {
      $reponse = ['metricValue' => ['type' => 'string', 'length' => '3'],
                  'dtime' => ['type' => 'string', 'length' => '3'],
                 ];

      return $reponse;
    }
}

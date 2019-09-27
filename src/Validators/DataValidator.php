<?php
declare(strict_types=1);

namespace App\Validators;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Psr\Log\LoggerInterface;

/**
 * JsonValidator - checks if json data has correct format, readable by Analyser
 */
class DataValidator
{

    /** @var \Psr\Log\LoggerInterface  */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Check request array for required keys
     */
    public function checkArrayKeys($data, $constraints)
    {
        // check for required keys in data array
        foreach ($constraints as $key => $value) {
            foreach ($data as $item) {
              if (!array_key_exists($key, $item)) {
                  $message = 'Data payload is missing '. $key;
                  // send message to monolog
                  $this->logger->error(json_encode($message));
                  // throw exception - missing key is an exception
                  throw new HttpException(400, $message);
              }
            }
        }
    }
}

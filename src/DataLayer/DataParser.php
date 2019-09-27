<?php
declare(strict_types=1);

namespace App\DataLayer;

/**
 * Data Parser - loading json data form file and transforming it to PHP array
 */
class DataParser
{
    /**
     * Load data from json file
     * @param $path
     * @return mixed
     */
    private function loadData($path)
    {
        $data = file_get_contents($path);

        return $data;
    }

    /**
     * Transform loaded json to array
     * @return array
     */
    public function json2array($path) {
        $array = json_decode($this->loadData($path), true);

        return $array;
    }
}

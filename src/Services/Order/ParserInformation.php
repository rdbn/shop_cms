<?php

namespace App\Services\Order;

use App\Services\Order\Parser\ArrayToString;
use App\Services\Order\Parser\StringToArray;

class ParserInformation
{
    private const DELIMITER = "---------------------------------------------------------------------------";

    /**
     * @param string $orderInformation
     * @return array
     */
    public function stringToArray(string $orderInformation): array
    {
        return (new StringToArray())->stringToArray($orderInformation, self::DELIMITER);
    }

    /**
     * @param array $orderInformation
     * @return string
     */
    public function arrayToString(array $orderInformation): string
    {
        return (new ArrayToString())->arrayToString($orderInformation, self::DELIMITER);
    }
}
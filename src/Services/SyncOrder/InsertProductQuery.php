<?php

namespace App\Services\SyncOrder;

class InsertProductQuery
{
    private const INSERT_SQL = "INSERT INTO `product`(name, price) VALUES ('%s', %f);";

    /**
     * @param string $name
     * @param float $price
     * @return string
     */
    public static function query(string $name, float $price): string
    {
        return sprintf(self::INSERT_SQL, $name, $price);
    }
}
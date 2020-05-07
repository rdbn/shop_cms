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
        $clearName = str_replace("/[^а-яa-zЁё0-9\s]/", '', $name);

        return sprintf(self::INSERT_SQL, $clearName, $price);
    }
}
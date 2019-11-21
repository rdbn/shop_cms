<?php

namespace App\Services\SyncOrder;

class InsertQuery
{
    private const INSERT_SQL = '
    INSERT INTO `order`(
        order_number, 
        price, 
        count_product, 
        order_date, 
        order_username, 
        order_information,
        address,
        tel,
        email
    ) VALUES (%d, %f, %d, %s, %s, %s, %s, %s, %s);';

    /**
     * @param array $values
     * @return string
     * @throws \Exception
     */
    public static function query(array $values): string
    {
        $date = (new \DateTimeImmutable($values["date_order"]))->format("Y-m-d H:i:s");

        return sprintf(self::INSERT_SQL,
            $values["n_order"],
            (float)$values["summa"],
            1,
            "'{$date}'",
            "'{$values["fio"]}'",
            "'{$values["order_txt"]}'",
            "'{$values["adress"]}'",
            "'{$values["tel"]}'",
            "'{$values["e_mail"]}'"
        );
    }
}
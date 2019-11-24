<?php

namespace App\Services\SyncOrder;

class InsertQuery
{
    private const INSERT_SQL = '
    INSERT INTO `order`(
        order_number, 
        price, 
        order_date, 
        order_username, 
        order_information,
        tel,
        email,
        city,
        house,
        podezd,
        floor,
        apartment,
        domofon        
    ) VALUES (%d, %f, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);';

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
            "'{$date}'",
            "'{$values["fio"]}'",
            "'{$values["order_txt"]}'",
            "'{$values["tel"]}'",
            "'{$values["e_mail"]}'",
            "'{$values["adress"]}'",
            "'{$values["house"]}'",
            "'{$values["porch"]}'",
            "'{$values["floor"]}'",
            "'{$values["flat"]}'",
            "'{$values["code"]}'"
        );
    }
}
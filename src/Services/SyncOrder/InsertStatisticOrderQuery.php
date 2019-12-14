<?php

namespace App\Services\SyncOrder;

class InsertStatisticOrderQuery
{
    private const INSERT_SQL = "INSERT INTO `statistic_order`(
        date, 
        hour,
        order_id,
        product_id,
        count_order_product,
        product_price
    ) VALUES ('%s', %d, %d, %d, %d, %f)
    ON DUPLICATE KEY UPDATE
        count_order_product=count_order_product + count_order_product,
        product_price=product_price + product_price
    ;";

    /**
     * @param array $product
     * @param int $orderId
     * @param int $productId
     * @return string
     * @throws \Exception
     */
    public static function query(array $product, int $orderId, int $productId): string
    {
        $date = new \DateTimeImmutable();

        return sprintf(self::INSERT_SQL,
            $date->format("Y-m-d"),
            $date->format("H"),
            $orderId,
            $productId,
            1,
            $product["price"]
        );
    }
}
<?php

namespace App\Services\Order;

use App\Connect\Connect;
use App\Dto\OrderDto;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;

class CreateOrder
{
    /**
     * @var Connection
     */
    private $dbal;

    /**
     * CreateOrder constructor.
     * @throws DBALException
     */
    public function __construct()
    {
        $this->dbal = (new Connect())->connect();
    }

    /**
     * @param OrderDto $order
     * @throws DBALException
     */
    public function create(OrderDto $order): void
    {
        try {
            $this->dbal->insert("`order`", [
                "order_number" => $order->orderNumber,
                "price" => $order->price,
                "order_date" => $order->orderDate,
                "count_product" => $order->countProduct,
                "order_username" => $order->orderUsername,
                "order_information" => $order->orderInformation,
            ]);
        } catch (DBALException $e) {
            throw new DBALException($e->getMessage());
        }
    }
}
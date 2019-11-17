<?php

namespace App\Services\Order;

use App\Connect\Connect;
use App\Dto\OrderCreate;
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
     * @param OrderCreate $orderCreate
     * @throws DBALException
     */
    public function create(OrderCreate $orderCreate): void
    {
        try {
            $this->dbal->insert("`order`", [
                "order_number" => $orderCreate->orderNumber,
                "price" => $orderCreate->price,
                "order_date" => $orderCreate->orderDate,
                "count_product" => $orderCreate->countProduct,
                "order_username" => $orderCreate->orderUsername,
                "order_information" => $orderCreate->orderInformation,
            ]);
        } catch (DBALException $e) {
            throw new DBALException($e->getMessage());
        }
    }
}
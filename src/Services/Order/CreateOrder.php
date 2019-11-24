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
                "price" => $order->price,
                "order_date" => $order->orderDate,
                "order_username" => $order->orderUsername,
                "order_information" => $order->orderInformation,
                "tel" => $order->tel,
                "address" => $order->address,
                "city" => $order->city,
                "street" => $order->street,
                "house" => $order->house,
                "podezd" => $order->podezd,
                "apartment" => $order->apartment,
                "floor" => $order->floor,
                "domofon" => $order->domofon,
                "sales" => $order->sales,
            ]);
        } catch (DBALException $e) {
            throw new DBALException($e->getMessage());
        }
    }
}
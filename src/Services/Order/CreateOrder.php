<?php

namespace App\Services\Order;

use App\Connect\Connect;
use App\Dto\OrderDto;
use App\Repository\ProductRepository;
use App\Services\SyncOrder\InsertProductQuery;
use App\Services\SyncOrder\InsertStatisticOrderQuery;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\Request;

class CreateOrder
{
    /**
     * @var Connection
     */
    private $dbal;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var int
     */
    private $orderId;

    /**
     * CreateOrder constructor.
     * @param Request $request
     * @throws DBALException
     */
    public function __construct(Request $request)
    {
        $this->dbal = (new Connect())->connect();
        $this->request = $request;
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
                "status" => $order->status,
                "sales" => $order->sales,
                "message" => $order->message,
                "count_persons" => $order->countPersons,
                "surrender" => $order->surrender,
                "courier_name" => $order->courierName,
            ]);
            $this->orderId = $this->dbal->lastInsertId();
        } catch (DBALException $e) {
            throw new DBALException($e->getMessage());
        }
    }

    /**
     * @param array $products
     * @throws \Exception
     */
    public function addStatistic(array $products): void
    {
        foreach ($products as $product) {
            $productId = (new ProductRepository())->findProductByName($product["name"]);
            if (false == $productId) {
                $this->dbal->executeQuery(InsertProductQuery::query($product["name"], $product["price"]));
                $productId = $this->dbal->lastInsertId();
            }
            $this->dbal->executeQuery(InsertStatisticOrderQuery::query($product, $this->orderId, $productId));
        }
    }
}
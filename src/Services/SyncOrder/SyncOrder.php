<?php

namespace App\Services\SyncOrder;

use App\Connect\Connect;
use App\Repository\OrderBitrixRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Services\Logger;
use App\Services\Order\ParserInformation;
use Doctrine\DBAL\DBALException;

class SyncOrder
{
    /**
     * @var Connect
     */
    private $dbal;

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var OrderBitrixRepository
     */
    private $orderBitrixRepository;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * SyncOrder constructor.
     * @throws DBALException
     */
    public function __construct()
    {
        $this->dbal = (new Connect())->connect();
        $this->orderRepository = new OrderRepository();
        $this->orderBitrixRepository = new OrderBitrixRepository();
        $this->logger = (new Logger('sync_order'))->getLogger();
    }

    /**
     * @throws \Exception
     */
    public function sync(): void
    {
        $orders = $this->orderBitrixRepository->findNewOrder();
        foreach ($orders as $order) {
            $orderInformation = $this->unserializable($order["C_FIELDS"]);
            if (!$orderInformation["n_order"]) {
                continue;
            }
            $orderNumberValue = $this->orderRepository->findOrdersByOrderNumber($orderInformation["n_order"]);
            if (false == $orderNumberValue) {
                try {
                    $this->dbal->executeQuery(InsertOrderQuery::query($orderInformation));
                    $orderId = $this->dbal->lastInsertId();
                    $parserOrderInformation = (new ParserInformation())->stringToArray($orderInformation["order_txt"]);
                    foreach ($parserOrderInformation["products"] as $product) {
                        $productId = (new ProductRepository())->findProductByName($product["name"]);
                        if (false == $productId) {
                            $this->dbal->executeQuery(InsertProductQuery::query($product["name"], $product["price"]));
                            $productId = $this->dbal->lastInsertId();
                        }
                        $this->dbal->executeQuery(InsertStatisticOrderQuery::query($product, $orderId, $productId));
                    }
                } catch (DBALException $e) {
                    $this->logger->error($e->getMessage());
                }
            }
        }
    }

    /**
     * @param string $string
     * @return array
     */
    private function unserializable(string $string)
    {
        $string2 = preg_replace_callback('!s:(\d+):"(.*?)";!s', function($m) {
            $len = strlen($m[2]);
            $result = "s:$len:\"{$m[2]}\";";
            return $result;
        }, $string);

        return unserialize($string2);
    }
}
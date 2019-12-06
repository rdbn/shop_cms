<?php

namespace App\Services\SyncOrder;

use App\Connect\Connect;
use App\Repository\OrderBitrixRepository;
use App\Repository\OrderRepository;
use App\Services\Logger;
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
                    $this->dbal->executeQuery(InsertQuery::query($orderInformation));
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
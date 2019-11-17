<?php

namespace App\Services\SyncOrder;

use App\Connect\Connect;
use App\Repository\OrderBitrixRepository;
use App\Services\Logger;
use Doctrine\DBAL\DBALException;

class SyncOrder
{
    /**
     * @var Connect
     */
    private $dbal;

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
        $this->orderBitrixRepository = new OrderBitrixRepository();
        $this->logger = (new Logger('sync_order'))->getLogger();
    }

    /**
     * @throws \Exception
     */
    public function sync(): void
    {
        $orders = $this->orderBitrixRepository->findNewOrder();
        $lastId = null;
        foreach ($orders as $order) {
            $order = $this->unserializable($order["C_FIELDS"]);
            if ($lastId != $order["n_order"]) {
                $lastId = $order["n_order"];
                try {
                    $this->dbal->executeQuery(InsertQuery::query($order));
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
    private function unserializable(string $string): array
    {
        $string2 = preg_replace_callback('!s:(\d+):"(.*?)";!s', function($m) {
            $len = strlen($m[2]);
            $result = "s:$len:\"{$m[2]}\";";
            return $result;
        }, $string);

        return unserialize($string2);
    }
}
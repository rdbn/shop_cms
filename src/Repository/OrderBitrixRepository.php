<?php

namespace App\Repository;

use App\Connect\ConnectBitrix;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;

class OrderBitrixRepository
{
    /**
     * @var Connection
     */
    private $dbal;

    /**
     * OrderRepository constructor.
     * @throws DBALException
     */
    public function __construct()
    {
        $this->dbal = (new ConnectBitrix())->connect();
    }

    /**
     * @return array
     * @throws DBALException
     */
    public function findNewOrder(): array
    {
        $date = (new \DateTimeImmutable("-15 minute"))->format("Y-m-d H:i:00");

        $stmt = $this->dbal->prepare("SELECT o.C_FIELDS FROM b_event o WHERE o.DATE_EXEC >= :date_event;");
        $stmt->bindValue("date_event", $date, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $orderId
     * @return false|mixed
     * @throws DBALException
     */
    public function findTypeDelivery(int $orderId)
    {
        $stmt = $this->dbal->prepare("
            SELECT 
                bipe.VALUE 
            FROM b_iblock_element_property o
                LEFT JOIN b_iblock_property_enum bipe ON o.IBLOCK_PROPERTY_ID = bipe.PROPERTY_ID
            WHERE bipe.ID = o.VALUE AND bipe.PROPERTY_ID = 213 AND o.IBLOCK_ELEMENT_ID = :order_id;
        ");
        $stmt->bindValue("order_id", $orderId, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
}
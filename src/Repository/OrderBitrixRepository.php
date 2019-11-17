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
        $date = (new \DateTimeImmutable("-1 minute"))->format("Y-m-d H:i:00");

        $stmt = $this->dbal->prepare("SELECT o.C_FIELDS FROM b_event o WHERE o.DATE_EXEC >= :date_event;");
        $stmt->bindValue("date_event", $date, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
<?php

namespace App\Repository;

use App\Connect\Connect;
use App\Dto\OrderFilter;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;

class OrderRepository
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
        $this->dbal = (new Connect())->connect();
    }

    /**
     * @param OrderFilter $filter
     * @return array
     * @throws DBALException
     */
    public function findOrdersByFilter(OrderFilter $filter): array
    {
        $qb = $this->dbal->createQueryBuilder();
        $qb
            ->addSelect("o.order_number")
            ->addSelect("o.price")
            ->addSelect("o.count_product")
            ->addSelect("o.order_date")
            ->addSelect("o.order_username")
            ->addSelect("o.order_information")
            ->from("`order`", "o")
            ->setFirstResult(($filter->page - 1) * $filter->limit)
            ->setMaxResults($filter->limit)
        ;

        $stmt = $this->dbal->prepare($qb->getSQL());
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param int $orderNumber
     * @return string
     * @throws DBALException
     */
    public function findOrdersByOrderNumber(int $orderNumber): string
    {
        $stmt = $this->dbal->prepare("SELECT o.id FROM `order` o WHERE o.order_number = :order_number");
        $stmt->bindValue("order_number", $orderNumber, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn();
    }
}
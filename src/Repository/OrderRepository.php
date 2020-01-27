<?php

namespace App\Repository;

use App\Connect\Connect;
use App\Dto\OrderDto;
use App\Dto\OrderFilterDto;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use function Doctrine\DBAL\Query\QueryBuilder;

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
     * @param OrderFilterDto $filter
     * @return array
     * @throws DBALException
     */
    public function findOrdersByFilter(OrderFilterDto $filter): array
    {
        $qb = $this->dbal->createQueryBuilder();
        $qb
            ->addSelect("o.*")
            ->from("`order`", "o")
            ->andWhere($qb->expr()->neq("o.status", OrderDto::STATUS["delete"]))
            ->orderBy("o.id", "DESC")
            ->setFirstResult(($filter->page - 1) * $filter->limit)
            ->setMaxResults($filter->limit)
        ;

        if ($filter->tel) {
            $qb->andWhere($qb->expr()->eq("o.tel", $this->dbal->quote($filter->tel)));
        }

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
        $stmt = $this->dbal->prepare("SELECT o.order_number FROM `order` o WHERE o.order_number = :order_number");
        $stmt->bindValue("order_number", $orderNumber, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * @param int $id
     * @return array
     * @throws DBALException
     */
    public function findOneById(int $id): array
    {
        $stmt = $this->dbal->prepare("SELECT o.* FROM `order` o WHERE o.id = :id");
        $stmt->bindParam("id", $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }
}
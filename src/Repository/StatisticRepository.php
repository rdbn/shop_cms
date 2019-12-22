<?php

namespace App\Repository;

use App\Connect\Connect;
use App\Dto\OrderDto;
use App\Dto\StatisticFilterDto;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;

class StatisticRepository
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
     * @param StatisticFilterDto $filterDto
     * @return array
     * @throws DBALException
     * @throws \Exception
     */
    public function findStatisticByFilter(StatisticFilterDto $filterDto): array
    {
        $qb = $this->dbal->createQueryBuilder();
        $qb
            ->addSelect("SUM(stat.count_order_product) as count")
            ->addSelect("SUM(stat.product_price) as price")
            ->from("statistic_order", "stat")
            ->andWhere($qb->expr()->gte("stat.date", $this->dbal->quote($filterDto->getDate()["from"]->format("Y-m-d"))))
            ->andWhere($qb->expr()->lte("stat.date", $this->dbal->quote($filterDto->getDate()["to"]->format("Y-m-d"))))
            ->setFirstResult(($filterDto->page - 1) * $filterDto->limit)
            ->setMaxResults($filterDto->limit)
        ;

        if ($filterDto->hourFrom) {
            $qb->andWhere($qb->expr()->gte("stat.hour", $filterDto->hourFrom));
        }

        if ($filterDto->hourTo) {
            $qb->andWhere($qb->expr()->lte("stat.hour", $filterDto->hourTo));
        }

        if ($filterDto->orderId) {
            $qb->andWhere($qb->expr()->eq("stat.order_id", $filterDto->orderId));
        }

        if ($filterDto->product) {
            $qb->andWhere($qb->expr()->eq("stat.product_id", $filterDto->product));
        }

        if ($filterDto->isEndOrder) {
            $qb
                ->leftJoin("stat", "`order`", "o", "stat.order_id = o.id")
                ->andWhere($qb->expr()->eq("o.status", OrderDto::STATUS["end"]));
        }

        switch ($filterDto->groupBy) {
            case StatisticFilterDto::GROUP_BY["date"]:
                $qb
                    ->addSelect("stat.date as name")
                    ->groupBy("stat.date")
                ;
                break;
            case StatisticFilterDto::GROUP_BY["hour"]:
                $qb
                    ->addSelect("CONCAT(stat.hour, ':00') as name")
                    ->groupBy("stat.hour")
                ;
                break;
            case StatisticFilterDto::GROUP_BY["product"]:
                $qb
                    ->addSelect("p.name as name")
                    ->leftJoin("stat", "`product`", "p", "stat.product_id = p.id")
                    ->groupBy("stat.product_id")
                ;
                break;
            case StatisticFilterDto::GROUP_BY["order_id"]:
                $qb
                    ->addSelect("stat.order_id as name")
                    ->groupBy("stat.order_id")
                ;
                break;
        }

        $stmt = $this->dbal->prepare($qb->getSQL());
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
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
            ->from("statistic_order", "stat")
            ->leftJoin("stat", "`product`", "p", "stat.product_id = p.id")
            ->leftJoin("stat", "`order`", "o", "stat.order_id = o.id")
            ->andWhere($qb->expr()->gte("stat.date", $this->dbal->quote($filterDto->getDate()["from"]->format("Y-m-d"))))
            ->andWhere($qb->expr()->lte("stat.date", $this->dbal->quote($filterDto->getDate()["to"]->format("Y-m-d"))))
            ->andWhere($qb->expr()->neq("o.status", OrderDto::STATUS["delete"]))
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
            $qb->andWhere($qb->expr()->eq("p.name", $this->dbal->quote($filterDto->product)));
        }

        if ($filterDto->isEndOrder) {
            $qb->andWhere($qb->expr()->eq("o.status", OrderDto::STATUS["end"]));
        }

        switch ($filterDto->groupBy) {
            case StatisticFilterDto::GROUP_BY["date"]:
                $qb
                    ->addSelect("stat.date as name")
                    ->addSelect("if(o.sales > 0, o.price - (o.sales * o.price / 100), o.price) as price")
                    ->groupBy("stat.date")
                    ->addGroupBy("stat.order_id")
                ;
                break;
            case StatisticFilterDto::GROUP_BY["hour"]:
                $qb
                    ->addSelect("CONCAT(stat.hour, ':00') as name")
                    ->addSelect("if(o.sales > 0, o.price - (o.sales * o.price / 100), o.price) as price")
                    ->groupBy("stat.hour")
                    ->addGroupBy("stat.order_id")
                ;
                break;
            case StatisticFilterDto::GROUP_BY["product"]:
                $qb
                    ->addSelect("p.name as name")
                    ->addSelect("SUM(stat.product_price) as price")
                    ->groupBy("stat.product_id")
                    ->addGroupBy("stat.order_id")
                ;
                break;
            case StatisticFilterDto::GROUP_BY["order_id"]:
                $qb
                    ->addSelect("stat.order_id as name")
                    ->addSelect("if(o.sales > 0, o.price - (o.sales * o.price / 100), o.price) as price")
                    ->groupBy("stat.order_id")
                    ->addGroupBy("stat.order_id")
                ;
                break;
        }

        $qbMain = $this->dbal->createQueryBuilder();
        $qbMain
            ->addSelect("SUM(main_stat.count) as count")
            ->addSelect("SUM(main_stat.price) as price")
            ->addSelect("name")
            ->from("({$qb->getSQL()})", "main_stat")
            ->groupBy("name")
            ->orderBy("name", "DESC")
            ->setFirstResult(($filterDto->page - 1) * $filterDto->limit)
            ->setMaxResults($filterDto->limit)
        ;

        $stmt = $this->dbal->prepare($qbMain->getSQL());
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
<?php

namespace App\Dto;

class StatisticFilterDto
{
    const GROUP_BY = [
        "date" => "date",
        "hour" => "hour",
        "order_id" => "order_id",
        "product" => "product",
    ];

    /**
     * @var string
     */
    public $groupBy = self::GROUP_BY["date"];

    /**
     * @var string
     */
    public $date;

    /**
     * @var int
     */
    public $hour;

    /**
     * @var int
     */
    public $orderId;

    /**
     * @var int
     */
    public $product;

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var int
     */
    public $limit = 20;

    /**
     * @return array|\DateTimeImmutable[]
     * @throws \Exception
     */
    public function getDate(): array
    {
        $dates = [];
        preg_match("|^(?P<from>\d\d.\d\d.\d\d\d\d).+(?P<to>\d\d.\d\d.\d\d\d\d)$|", $this->date, $dates);

        if (isset($dates['from']) && isset($dates['to'])) {
            $dates["from"] = new \DateTimeImmutable($dates['from']);
            $dates["to"] = new \DateTimeImmutable($dates['to']);
        } else {
            $dates["from"] = new \DateTimeImmutable("-30 day");
            $dates["to"] = new \DateTimeImmutable();
        }

        return $dates;
    }

    public function getDateToString(): string
    {
        $dateFrom = new \DateTimeImmutable("-30 day");
        $dateTo = new \DateTimeImmutable();

        return "{$dateFrom->format("d.m.Y")}-{$dateTo->format("d.m.Y")}";
    }

    /**
     * @return array
     */
    public function getGroupBys(): array
    {
        return self::GROUP_BY;
    }
}
<?php

namespace App\Repository;

use App\Connect\ConnectBitrix;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;

class ProductBitrixRepository
{
    /**
     * @var Connection
     */
    private $dbal;

    /**
     * ProductBitrixRepository constructor.
     * @throws DBALException
     */
    public function __construct()
    {
        $this->dbal = (new ConnectBitrix())->connect();
    }

    /**
     * @param string $name
     * @return array
     * @throws DBALException
     */
    public function findProductByName(string $name): array
    {
        $name = mb_strtoupper($name, "utf-8");
        $stmt = $this->dbal->prepare("
        SELECT p.NAME as name, MAX(biep.VALUE_NUM) as price FROM b_iblock_element p
            LEFT JOIN b_iblock_element_property biep on p.ID = biep.IBLOCK_ELEMENT_ID
        WHERE
            p.NAME LIKE :name_product
        GROUP BY p.NAME
        HAVING price IS NOT NULL
        LIMIT 20;
        ");
        $stmt->bindValue("name_product", "%{$name}%", \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
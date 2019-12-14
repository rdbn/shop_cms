<?php

namespace App\Repository;

use App\Connect\Connect;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;

class ProductRepository
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
        $this->dbal = (new Connect())->connect();
    }

    /**
     * @param string $name
     * @return int|false
     * @throws DBALException
     */
    public function findProductByName(string $name)
    {
        $name = mb_strtolower($name, "utf-8");
        $stmt = $this->dbal->prepare("SELECT p.id FROM product p WHERE p.name = :name_product");
        $stmt->bindValue("name_product", $name, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * @param string $name
     * @return array
     * @throws DBALException
     */
    public function findProductByLikeName(string $name): array
    {
        $name = mb_strtolower($name, "utf-8");
        $stmt = $this->dbal->prepare("SELECT p.name FROM product p WHERE p.name LIKE :name_product LIMIT 20;");
        $stmt->bindValue("name_product", "%{$name}%", \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
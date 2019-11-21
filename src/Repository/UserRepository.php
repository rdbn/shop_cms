<?php

namespace App\Repository;

use App\Connect\Connect;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;

class UserRepository
{
    /**
     * @var Connection
     */
    private $dbal;

    /**
     * UserRepository constructor.
     * @throws DBALException
     */
    public function __construct()
    {
        $this->dbal = (new Connect())->connect();
    }

    /**
     * @param $username
     * @return mixed
     * @throws DBALException
     */
    public function findUserByUsername($username)
    {
        $stmt = $this->dbal->prepare("SELECT u.* FROM user u WHERE u.username = :username");
        $stmt->bindValue("username", $username, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
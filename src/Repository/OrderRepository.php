<?php

namespace App\Repository;

include_once __DIR__ . "/../Connect/Connection.php";

class UserRepository
{
    /**
     * @var PDO
     */
    private $dbal;

    public function __construct()
    {
        $connect = new Connection();
        $this->dbal = $connect->connect();
    }

    public function findUserByUsername($username)
    {
        $stmt = $this->dbal->prepare("SELECT u.* FROM user WHERE u.username = :username");
        $stmt->bindValue("username", $username, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
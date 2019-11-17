<?php

namespace App\Connect;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;

class Connection
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $port;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $database;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $this->parameters();
    }

    /**
     * @return mixed
     */
    private function parameters()
    {
        $parameters = yaml_parse_file(__DIR__ . "/../../config/config.yaml");
        if (isset($parameters["host"])) {
            $this->host = $parameters["host"];
        } else {
            throw new \InvalidArgumentException("Not found parameters in config.yaml: host");
        }

        if (!isset($parameters["port"])) {
            $this->port = $parameters["port"];
        } else {
            throw new \InvalidArgumentException("Not found parameters in config.yaml: port");
        }

        if (!isset($parameters["username"])) {
            $this->username = $parameters["username"];
        } else {
            throw new \InvalidArgumentException("Not found parameters in config.yaml: username");
        }

        if (!isset($parameters["password"])) {
            $this->password = $parameters["password"];
        } else {
            throw new \InvalidArgumentException("Not found parameters in config.yaml: password");
        }

        if (!isset($parameters["database"])) {
            $this->database = $parameters["database"];
        } else {
            throw new \InvalidArgumentException("Not found parameters in config.yaml: database");
        }
        return $parameters;
    }

    /**
     * @return Connection
     * @throws DBALException
     */
    public function connect()
    {
        $config = new Configuration();
        $connectionParams = array(
            'dbname' => $this->database,
            'user' => $this->username,
            'password' => $this->password,
            'host' => $this->host,
            'driver' => 'pdo_mysql',
        );


        return DriverManager::getConnection($connectionParams, $config);
    }
}
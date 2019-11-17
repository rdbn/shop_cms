<?php

namespace App\Connect;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;
use Symfony\Component\Yaml\Yaml;

class ConnectBitrix
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
     * Connect constructor.
     */
    public function __construct()
    {
        $this->parameters();
    }

    /**
     * @return mixed
     */
    private function parameters(): array
    {
        $parameters = Yaml::parseFile(__DIR__ . "/../../config/config.yaml");
        if (!isset($parameters["parameters"])) {
            throw new \InvalidArgumentException("Not found parameters in config.yaml: parameters");
        }

        if (isset($parameters["parameters"]["host_bitrix"])) {
            $this->host = $parameters["parameters"]["host_bitrix"];
        } else {
            throw new \InvalidArgumentException("Not found parameters in config.yaml: host");
        }

        if (isset($parameters["parameters"]["port_bitrix"])) {
            $this->port = $parameters["parameters"]["port_bitrix"];
        } else {
            throw new \InvalidArgumentException("Not found parameters in config.yaml: port");
        }

        if (isset($parameters["parameters"]["username_bitrix"])) {
            $this->username = $parameters["parameters"]["username_bitrix"];
        } else {
            throw new \InvalidArgumentException("Not found parameters in config.yaml: username");
        }

        if (isset($parameters["parameters"]["password_bitrix"])) {
            $this->password = $parameters["parameters"]["password_bitrix"];
        } else {
            throw new \InvalidArgumentException("Not found parameters in config.yaml: password");
        }

        if (isset($parameters["parameters"]["database_bitrix"])) {
            $this->database = $parameters["parameters"]["database_bitrix"];
        } else {
            throw new \InvalidArgumentException("Not found parameters in config.yaml: database");
        }
        return $parameters;
    }

    /**
     * @return Connection
     * @throws DBALException
     */
    public function connect(): Connection
    {
        $config = new Configuration();
        $connectionParams = array(
            'dbname' => $this->database,
            'user' => $this->username,
            'password' => $this->password,
            'host' => $this->host,
            'driver' => 'pdo_mysql',
            'charset' => 'utf8'
        );


        return DriverManager::getConnection($connectionParams, $config);
    }
}
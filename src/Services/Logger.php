<?php

namespace App\Services;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;

class Logger
{
    /**
     * @var MonologLogger
     */
    private $log;

    /**
     * Logger constructor.
     * @param string $name
     * @throws \Exception
     */
    public function __construct(string $name)
    {
        $this->log = new MonologLogger($name);
        $this->log->pushHandler(new StreamHandler(__DIR__ . "/../../log/{$name}.log", MonologLogger::INFO));
    }

    /**
     * @return MonologLogger
     */
    public function getLogger(): MonologLogger
    {
        return $this->log;
    }
}
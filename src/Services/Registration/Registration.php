<?php

namespace App\Services\Registration;

use App\Connect\Connect;
use App\Dto\RegistrationDto;
use App\Services\Authorization\PasswordEncoder;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;

class Registration
{
    /**
     * @var Connection
     */
    private $dbal;

    /**
     * RegistrationDto constructor.
     * @throws DBALException
     */
    public function __construct()
    {
        $this->dbal = (new Connect())->connect();
    }

    /**
     * @param RegistrationDto $registration
     * @throws DBALException
     */
    public function registration(RegistrationDto $registration): void
    {
        $this->dbal->insert("`user`", [
            "username" => $registration->username,
            "password" => (new PasswordEncoder())->encodePassword($registration->password),
        ]);
    }
}
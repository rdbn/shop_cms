<?php

namespace App\Services\Authorization;

use App\Dto\Login;
use App\Repository\UserRepository;
use App\Services\Authorization\Exception\AuthorizationFailedException;
use Doctrine\DBAL\DBALException;

class UserProvider
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var PasswordEncoder
     */
    private $passwordEncoder;

    /**
     * UserProvider constructor.
     * @throws DBALException
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->passwordEncoder = new PasswordEncoder();
    }

    /**
     * @param Login $login
     * @return mixed
     * @throws AuthorizationFailedException
     * @throws DBALException
     */
    public function loadUserByUsername(Login $login): array
    {
        $user = $this->userRepository->findUserByUsername($login->username);
        if (false == $user) {
            throw AuthorizationFailedException::failed();
        }

        if (!$this->passwordEncoder->checkPassword($login->password, $user["password"])) {
            throw AuthorizationFailedException::failed();
        }
        return $user;
    }
}
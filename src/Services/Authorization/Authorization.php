<?php

namespace App\Services\Authorization;

use App\Dto\Login;
use App\Repository\UserRepository;
use App\Services\Authorization\Exception\AuthorizationFailedException;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorization
{
    /**
     * @var Request
     */
    public $request;

    /**
     * @var Request
     */
    public $userProvider;

    /**
     * @var AuthorizationChecker
     */
    public $authorizationChecker;

    /**
     * AuthService constructor.
     * @param Request $request
     * @throws DBALException
     */
    public function __construct(Request $request)
    {
        $this->userProvider = new UserProvider();
        $this->authorizationChecker = new AuthorizationChecker($request);
    }

    /**
     * @param Login $login
     * @throws AuthorizationFailedException
     * @throws DBALException
     */
    public function authorization(Login $login): void
    {
        $user = $this->userProvider->loadUserByUsername($login);
        $this->authorizationChecker->setAuthorization($user["username"]);
    }
}
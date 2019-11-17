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
     * @var UserRepository
     */
    public $userRepository;

    /**
     * AuthService constructor.
     * @param Request $request
     * @throws DBALException
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->userRepository = new UserRepository();
    }

    /**
     * @param Login $login
     * @throws AuthorizationFailedException
     */
    public function authorization(Login $login): void
    {
        $user = $this->getUser($login);

        $this->request->getSession()->set("user", $user["username"]);

        $response = new Response();
        $response->headers->setCookie(Cookie::create("user", $user["username"]));
        $response->send();
    }

    /**
     * @param Login $login
     * @return array
     * @throws AuthorizationFailedException
     */
    private function getUser(Login $login): array
    {
        $user = $this->userRepository->findUserByUsername($login->username);
        if (false == $user) {
            throw AuthorizationFailedException::failed();
        }

        if ($this->checkPassword($login->password, $user["password"])) {
            throw AuthorizationFailedException::failed();
        }

        return $user;
    }

    /**
     * @param $password
     * @param $userPassword
     * @return bool
     */
    private function checkPassword($password, $userPassword): bool
    {
        $hashPassword = hash("sha256", $password);
        if ($hashPassword == $userPassword) {
            return true;
        }
        return false;
    }
}
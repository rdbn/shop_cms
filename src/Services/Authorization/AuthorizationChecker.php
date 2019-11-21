<?php

namespace App\Services\Authorization;

use Symfony\Component\HttpFoundation\Request;

class AuthorizationChecker
{
    private const SESSION_NAME = "authorization";

    /**
     * @var Request
     */
    private $request;

    /**
     * AuthorizationChecker constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function isAuthorization(): bool
    {
        if ($this->request->getSession()->has(self::SESSION_NAME)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $username
     */
    public function setAuthorization(string $username): void
    {
        $this->request->getSession()->set(self::SESSION_NAME, $username);
    }
}
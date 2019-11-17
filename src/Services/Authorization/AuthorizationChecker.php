<?php

namespace App\Services\Authorization;

use Symfony\Component\HttpFoundation\Request;

class AuthorizationChecker
{
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

    public function checker(): void
    {

    }
}
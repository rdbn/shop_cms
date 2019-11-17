<?php

namespace App\Services\Authorization\Exception;

class AuthorizationFailedException extends \Exception
{
    public static function failed()
    {
        return new self("Invalid username or password!");
    }
}
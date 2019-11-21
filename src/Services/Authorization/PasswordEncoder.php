<?php

namespace App\Services\Authorization;


class PasswordEncoder
{
    /**
     * @param $password
     * @param $userPassword
     * @return bool
     */
    public function checkPassword($password, $userPassword): bool
    {
        if (password_verify($password, $userPassword)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $password
     * @return string
     */
    public function encodePassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT, ["cost" => 12]);
    }
}
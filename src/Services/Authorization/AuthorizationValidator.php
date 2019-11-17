<?php

namespace App\Services;

use App\Repository\UserRepository;

class Authorization
{
    /**
     * @var UserRepository
     */
    public $userRepository;

    /**
     * AuthService constructor.
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * @param $username
     * @param $password
     */
    public function authorization($username, $password)
    {
        $this->userRepository->findUserByUsername($username);
    }

    private function checkPassword($password, $userPassword)
    {
        $userPassword = hash("sha256", $userPassword);

    }
}
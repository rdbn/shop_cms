<?php

namespace App\Services\Authorization;

use App\Dto\Login;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class LoginValidator
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var Login
     */
    private $login;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var array
     */
    private $errorMessages;

    /**
     * LoginValidator constructor.
     */
    public function __construct()
    {
        $this->validator = Validation::createValidatorBuilder()
            ->addMethodMapping("loadValidatorMetadata")
            ->getValidator();
    }

    /**
     * @param Request $request
     */
    public function handlerRequest(Request $request): void
    {
        $this->request = $request;
        if (!$this->isSubmit()) {
            return;
        }

        $this->login = new Login();
        $this->login->username = $this->request->request->get("username");
        $this->login->password = $this->request->request->get("password");

        $errors = $this->validator->validate($this->login);
        if ($errors->count()) {
            foreach ($errors as $error) {
                $this->errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }
        }
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        if (!$this->isSubmit()) {
            return false;
        }

        if (count($this->errorMessages) == 0) {
            return true;
        }
        return false;
    }

    /**
     * @return Login
     */
    public function getLogin(): Login
    {
        return $this->login;
    }

    /**
     * @return bool
     */
    private function isSubmit(): bool
    {
        return $this->request->request->has("username") && $this->request->request->has("password");
    }
}
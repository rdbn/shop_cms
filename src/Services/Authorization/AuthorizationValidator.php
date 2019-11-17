<?php

namespace App\Services\Authorization;

use App\Dto\Login;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthorizationValidator
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
     * AuthorizationValidator constructor.
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
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        if (!$this->isSubmit()) {
            return false;
        }

        $this->validate();
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
        if ($this->request->request->has("username") && $this->request->request->has("password")) {
            return true;
        }
        return false;
    }

    private function validate(): void
    {
        $errors = $this->validator->validate($this->login);
        if ($errors->count()) {
            foreach ($errors as $error) {
                $this->errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }
        }
    }
}
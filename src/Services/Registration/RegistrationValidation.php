<?php

namespace App\Services\Registration;

use App\Dto\RegistrationDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationValidation
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var RegistrationDto
     */
    private $registration;

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

        $this->registration = new RegistrationDto();
        $this->registration->username = $this->request->request->get("username");
        $this->registration->password = $this->request->request->get("password");

        $errors = $this->validator->validate($this->registration);
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
     * @return RegistrationDto
     */
    public function getRegistration(): RegistrationDto
    {
        return $this->registration;
    }

    /**
     * @return bool
     */
    private function isSubmit(): bool
    {
        return $this->request->request->has("username") && $this->request->request->has("password");
    }
}
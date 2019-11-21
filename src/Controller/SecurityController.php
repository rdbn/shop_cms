<?php

namespace App\Controller;

use App\Services\Authorization\Authorization;
use App\Services\Authorization\LoginValidator;
use App\Services\Registration\Registration;
use App\Services\Registration\RegistrationValidation;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     */
    public function login(): Response
    {
        $authorizationValidate = new LoginValidator();
        $authorizationValidate->handlerRequest($this->request);

        if ($authorizationValidate->isValid()) {
            $authorization = new Authorization($this->request);
            $authorization->authorization($authorizationValidate->getLogin());

            $this->redirect();
        }

        return $this->renderTemplate("authorization/login_form");
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function registration()
    {
        $authorizationValidate = new RegistrationValidation();
        $authorizationValidate->handlerRequest($this->request);

        if ($authorizationValidate->isValid()) {
            $authorization = new Registration();
            $authorization->registration($authorizationValidate->getRegistration());

            $this->redirect();
        }

        return $this->renderTemplate("authorization/registration_form");
    }
}
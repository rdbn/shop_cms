<?php

namespace App\Controller;

use App\Services\Authorization\Authorization;
use App\Services\Authorization\AuthorizationValidator;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     */
    public function login(): Response
    {
        $authorizationValidate = new AuthorizationValidator();
        $authorizationValidate->handlerRequest($this->request);

        if ($authorizationValidate->isValid()) {
            $authorization = new Authorization($this->request);
            $authorization->authorization($authorizationValidate->getLogin());

            $this->redirect();
        }

        return $this->renderTemplate("authorization/login_form");
    }
}
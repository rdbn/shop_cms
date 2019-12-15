<?php

namespace App\Controller;

use App\Services\Authorization\AuthorizationChecker;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AbstractController
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * AbstractController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        if (
            $request->getPathInfo() != "/login"
            && $request->getPathInfo() != "/registration"
            && !((new AuthorizationChecker($request))->isAuthorization())
        ) {
            $this->redirect("login");
        }
    }

    /**
     * @param string $templateName
     * @param array $variableTemplate
     * @return Response
     * @throws \Exception
     */
    protected function renderTemplate(string $templateName, array $variableTemplate = []): Response
    {
        foreach ($variableTemplate as $nameVariable => $valueVariable) {
            ${$nameVariable} = $valueVariable;
        }

        ob_start();
        include_once(__DIR__ . "/../../Template/{$templateName}.php");
        $template = ob_get_clean();
        if (!$template) {
            throw new \Exception("Template not found");
        }

        return new Response($template);
    }

    /**
     * @param string $path
     * @param int $status
     */
    protected function redirect(string $path = "", int $status = 302): void
    {
        header("Location: {$this->request->getSchemeAndHttpHost()}/{$path}", true, $status);
        exit();
    }

    /**
     * @param array $data
     * @param int $status
     * @return Response
     */
    protected function jsonResponse(array $data, $status = 200): Response
    {
        return new JsonResponse($data, $status, ['content-type' => 'application/json']);
    }
}
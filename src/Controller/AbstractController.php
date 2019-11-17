<?php

namespace App\Controller;

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
        $template = include_once(__DIR__ . "/../../Template/{$templateName}.php");
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
}
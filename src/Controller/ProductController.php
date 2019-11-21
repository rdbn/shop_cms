<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductController extends AbstractController
{
    public function search()
    {
        try {
            $products = (new ProductRepository())
                ->findProductByName($this->request->query->get("query", ""));
        } catch (DBALException $e) {
            $products = [];
        }

        return $this->jsonResponse($products);
    }
}
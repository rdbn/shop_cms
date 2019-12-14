<?php

namespace App\Controller;

use App\Repository\ProductBitrixRepository;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    public function search(): Response
    {
        try {
            $products = (new ProductBitrixRepository())
                ->findProductByName($this->request->query->get("query", ""));
        } catch (DBALException $e) {
            $products = [];
        }

        return $this->jsonResponse($products);
    }
}
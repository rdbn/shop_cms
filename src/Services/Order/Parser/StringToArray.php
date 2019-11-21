<?php

namespace App\Services\Order\Parser;

class StringToArray
{
    /**
     * @param string $orderInformation
     * @param $delimiter
     * @return array
     */
    public function stringToArray(string $orderInformation, string $delimiter): array
    {
        $orderInformation = explode($delimiter, $orderInformation);

        if (count($orderInformation) == 3) {
            return [
                "products" => $this->productsOrder($orderInformation[0]),
                "final" => $this->finalInformation($orderInformation[1]),
                "orderInformation" => $this->orderInformation($orderInformation[2]),
            ];
        }

        return [
            "products" => $this->productsOrder($orderInformation[0]),
            "final" => $this->finalInformation($orderInformation[1]),
            "present" => $this->presentInformation($orderInformation[2]),
            "orderInformation" => $this->orderInformation($orderInformation[3]),
        ];
    }

    /**
     * @param string $orderInformation
     * @return array
     */
    private function productsOrder(string $orderInformation): array
    {
        $orderInformation = explode("\n\r\n", $orderInformation);
        $products = [];
        foreach ($orderInformation as $information) {
            $product = explode("\n", $information);
            if (count($product) == 2) {
                $productInformation = explode(" -- ", $product[1]);
                $countProduct = explode(" X ", $productInformation[0]);
                $product[1] = [
                    "price" => (float)str_replace(" ", "", $countProduct[0]),
                    "price_total" => (float)str_replace(" ", "", $productInformation[1]),
                    "count" => (int)$countProduct[1],
                ];
                $products[] = $product;
            }
        }
        return $products;
    }

    /**
     * @param string $orderInformation
     * @return array
     */
    private function finalInformation(string $orderInformation): array
    {
        $orderInformation = explode("\n\r\n", $orderInformation);
        $orderInformation = explode("\n", $orderInformation[1]);
        $finalInformation = [];
        foreach ($orderInformation as $information) {
            $information = explode(": ", $information);
            $finalInformation[$information[0]] = (float)str_replace(" ", "", $information[1]);
        }
        return $finalInformation;
    }

    /**
     * @param string $orderInformation
     * @return array
     */
    private function presentInformation(string $orderInformation): array
    {
        $orderInformation = explode("\n\r\n", $orderInformation);
        $orderInformation = explode("\n", $orderInformation[2]);

        return $orderInformation;
    }

    /**
     * @param string $orderInformation
     * @return array
     */
    private function orderInformation(string $orderInformation): array
    {
        $orderInformation = explode("\n\r\n", $orderInformation);
        $orderInformation = explode("\n", $orderInformation[1]);
        $addInformation = [];
        foreach ($orderInformation as $information) {
            $information = explode(": ", $information);
            $addInformation[$information[0]] = $information[1];
        }
        return $addInformation;
    }
}
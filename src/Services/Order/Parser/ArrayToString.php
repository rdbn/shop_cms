<?php

namespace App\Services\Order\Parser;

class ArrayToString
{
    /**
     * @param array $orderInformation
     * @param string $delimiter
     * @return string
     */
    public function arrayToString(array $orderInformation, string $delimiter): string
    {
        if (count($orderInformation) == 3) {
            return implode($delimiter, [
                $this->productsOrder($orderInformation["product"]),
                $this->finalInformation($orderInformation["final"]),
                $this->orderInformation($orderInformation["orderInformation"]),
            ]);
        }

        return implode($delimiter, [
            $this->productsOrder($orderInformation["product"]),
            $this->finalInformation($orderInformation["final"]),
            $this->presentInformation($orderInformation["present"]),
            $this->orderInformation($orderInformation["orderInformation"]),
        ]);
    }

    /**
     * @param array $products
     * @return string
     */
    private function productsOrder(array $products): string
    {
        $valueProducts = [];
        foreach ($products as $product) {
            $price = "{$product["price"]}руб.";
            $priceTotal = "{$product["price_total"]}руб.";
            $priceCount = implode(" X ", [$price, $product["count"]]);
            $priceCount = implode(" -- ", [$priceCount, $priceTotal]);
            $valueProducts[] = implode("\n", [trim($product["name"]), $priceCount]);
        }
        return implode("\n\r\n", $valueProducts);
    }

    /**
     * @param array $finalInformation
     * @return string
     */
    private function finalInformation(array $finalInformation): string
    {
        $valueInformation = [];
        foreach ($finalInformation as $key => $information) {
            $valueInformation[] = implode(": ", [$key, $information]);
        }
        $valueInformation = implode("\n", $valueInformation);
        $valueInformation = implode("\n\r\n", ["", $valueInformation, ""]);

        return $valueInformation;
    }

    /**
     * @param array $presentInformation
     * @return string
     */
    private function presentInformation(array $presentInformation): string
    {
        $presentInformation = implode("\n", array_map(function ($item) { return trim($item); }, $presentInformation));
        return implode("\n\r\n", ["", "Выбрать подарки:", $presentInformation, ""]);
    }

    /**
     * @param array $orderInformation
     * @return string
     */
    private function orderInformation(array $orderInformation): string
    {
        $valueInformation = [];
        foreach ($orderInformation as $key => $information) {
            $valueInformation[] = implode(": ", [$key, trim($information)]);
        }
        $valueInformation = implode("\n", $valueInformation);
        return implode("\n\r\n", ["", $valueInformation, ""]);
    }
}
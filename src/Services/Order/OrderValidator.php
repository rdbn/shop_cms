<?php

namespace App\Services\Order;

use App\Dto\OrderDto;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderValidator
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var OrderDto
     */
    private $order;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var array
     */
    private $errorMessages = [];

    /**
     * OrderValidator constructor.
     * @param OrderDto $orderDto
     */
    public function __construct(OrderDto $orderDto)
    {
        $this->order = $orderDto;
        $this->validator = Validation::createValidatorBuilder()
            ->addMethodMapping("loadValidatorMetadata")
            ->getValidator();
    }

    /**
     * @param Request $request
     */
    public function handleRequest(Request $request): void
    {
        $this->request = $request;
        if (!$this->request->request->has("create_order")) {
            return;
        }

        $request = $this->request->request->get("create_order");

        $this->order->orderNumber = $request["order_number"];
        $this->order->price = $request["price"];
        $this->order->countProduct = $request["count_product"];
        $this->order->orderUsername = $request["order_username"];
        $this->order->orderInformation = $request["order_information"];

        $errors = $this->validator->validate($this->order);
        if ($errors->count() > 0) {
            foreach ($errors as $error) {
                $this->errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }
        }
    }

    public function getOrder(): OrderDto
    {
        return $this->order;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        if (count($this->errorMessages) == 0 && $this->request->request->has("create_order")) {
            return true;
        }
        return false;
    }

    /**
     * @return array
     */
    public function errorMessages(): array
    {
        return $this->errorMessages;
    }
}
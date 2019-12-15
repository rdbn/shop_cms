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

        $this->order->price = $request["order_information"]["final"]["Сумма"];
        $this->order->orderUsername = $request["order_username"];
        if (isset($request["order_information"]["products"])) {
            $this->order->orderInformation = (new ParserInformation())->arrayToString($request["order_information"]);
        }
        $this->order->tel = $request["tel"];
        $this->order->city = $request["city"];
        $this->order->street = $request["street"];
        $this->order->house = $request["house"];
        $this->order->podezd = $request["podezd"];
        $this->order->apartment = $request["apartment"];
        $this->order->floor = $request["floor"];
        $this->order->domofon = $request["domofon"];
        $this->order->sales = $request["sale"];
        $this->order->message = $request["message"];
        $this->order->countPersons = $request["count_persons"];
        $this->order->surrender = $request["surrender"];
        $this->order->courierName = $request["courier_name"];

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
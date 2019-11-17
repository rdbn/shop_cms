<?php

namespace App\Controller;

use App\Dto\OrderDto;
use App\Dto\OrderFilterDto;
use App\Repository\OrderRepository;
use App\Services\Order\CreateOrder;
use App\Services\Order\EditOrder;
use App\Services\Order\OrderValidator;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class OrderController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     */
    public function orders(): Response
    {
        $orderFilter = new OrderFilterDto();
        $orderFilter->page = $this->request->query->getInt("page", 1);
        $orderFilter->limit = $this->request->query->getInt("limit", 20);

        try {
            $orders = (new OrderRepository())->findOrdersByFilter($orderFilter);
        } catch (DBALException $e) {
            $orders = [];
        }

        return $this->renderTemplate("orders/orders", [
            "orders" => $orders
        ]);
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function create(): Response
    {
        $orderValidator = new OrderValidator(new OrderDto());
        $orderValidator->handleRequest($this->request);

        if ($orderValidator->isValid()) {
            (new CreateOrder())->create($orderValidator->getOrder());
            $this->redirect();
        }

        return $this->renderTemplate("orders/form_orders", [
            "requestValue" => $this->request->request->get("create_order"),
            "errorMessages" => $orderValidator->errorMessages(),
        ]);
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function edit(): Response
    {
        $orderDto = new OrderDto();
        $orderDto->id = $this->request->query->getInt("id");

        $order = (new OrderRepository())->findOneById($orderDto->id);
        if (count($order) == 0) {
            throw new ResourceNotFoundException();
        }

        $orderValidator = new OrderValidator($orderDto);
        $orderValidator->handleRequest($this->request);

        if ($orderValidator->isValid()) {
            (new EditOrder())->edit($orderValidator->getOrder());
            $this->redirect();
        }

        return $this->renderTemplate("orders/form_orders", [
            "requestValue" => array_merge($order, $this->request->request->get("create_order", [])),
            "errorMessages" => $orderValidator->errorMessages(),
        ]);
    }
}
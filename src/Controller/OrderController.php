<?php

namespace App\Controller;

use App\Connect\Connect;
use App\Dto\OrderDto;
use App\Dto\OrderFilterDto;
use App\Repository\OrderRepository;
use App\Services\Order\CreateOrder;
use App\Services\Order\EditOrder;
use App\Services\Order\OrderValidator;
use App\Services\Order\ParserInformation;
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
        $page = $this->request->query->getInt("page", 1);
        $limit = $this->request->query->getInt("limit", 20);

        $orderFilter = new OrderFilterDto();
        $orderFilter->page = $page;
        $orderFilter->limit = $limit;

        try {
            $orders = (new OrderRepository())->findOrdersByFilter($orderFilter);
            $orders = array_map(function ($item) {
                $item["order_information"] = (new ParserInformation())->stringToArray($item["order_information"]);
                return $item;
            }, $orders);
        } catch (DBALException $e) {
            $orders = [];
        }

        return $this->renderTemplate("orders/orders", [
            "orders" => $orders,
            "limit" => $limit,
            "page" => $page,
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

        if (!is_array($order["order_information"])) {
            $order["order_information"] = (new ParserInformation())->stringToArray($order["order_information"]);
        }

        return $this->renderTemplate("orders/form_orders", [
            "requestValue" => array_merge($order, $this->request->request->get("create_order", [])),
            "errorMessages" => $orderValidator->errorMessages(),
        ]);
    }

    /**
     * @throws DBALException
     */
    public function changeStatus(): void
    {
        $order = (new OrderRepository())->findOneById($this->request->query->getInt("id", 0));
        if (count($order) == 0) {
            throw new ResourceNotFoundException();
        }

        (new Connect())->connect()
            ->update("`order`", [
                "status" => OrderDto::STATUS["end"]
            ], ["id" => $order["id"]]);

        $this->redirect();
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function printVersion(): Response
    {
        $order = (new OrderRepository())->findOneById($this->request->query->getInt("id", 0));
        if (count($order) == 0) {
            throw new ResourceNotFoundException();
        }

        $order["order_information"] = (new ParserInformation())->stringToArray($order["order_information"]);

        return $this->renderTemplate("orders/printVersion", [
            "order" => $order,
        ]);
    }
}
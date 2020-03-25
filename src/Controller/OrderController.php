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
        $orderFilter = new OrderFilterDto();
        $orderFilter->tel = $this->request->query->get("tel", null);
        $orderFilter->page = $this->request->query->getInt("page", 1);
        $orderFilter->limit = $this->request->query->getInt("limit", 40);

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
            "orderFilter" => $orderFilter,
            "orders" => $orders,
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
            $createOrder = new CreateOrder($this->request);
            $createOrder->create($orderValidator->getOrder());
            $createOrder->addStatistic($this->request->request->get("create_order")["order_information"]["products"]);

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

        switch ($this->request->query->getInt("status")) {
            case OrderDto::STATUS["end"]:
                $status = OrderDto::STATUS["end"];
                break;
            case OrderDto::STATUS["in_work"]:
                $status = OrderDto::STATUS["in_work"];
                break;
            case OrderDto::STATUS["delete"]:
                $status = OrderDto::STATUS["delete"];
                break;
            default:
                throw new ResourceNotFoundException();
        }

        (new Connect())->connect()->update("`order`", ["status" => $status], ["id" => $order["id"]]);

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

        (new Connect())->connect()->update("`order`", ["status" => OrderDto::STATUS["in_work"]], ["id" => $order["id"]]);

        $order["order_information"] = (new ParserInformation())->stringToArray($order["order_information"]);

        return $this->renderTemplate("orders/printVersion", [
            "order" => $order,
        ]);
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function ajaxOrder(): Response
    {
        $orderFilter = new OrderFilterDto();
        $orderFilter->tel = $this->request->query->get("tel", null);
        $orderFilter->page = $this->request->query->getInt("page", 1);
        $orderFilter->limit = $this->request->query->getInt("limit", 20);

        try {
            $orders = (new OrderRepository())->findOrdersByFilter($orderFilter);
            $orders = array_map(function ($item) {
                $item["order_information"] = (new ParserInformation())->stringToArray($item["order_information"]);
                return $item;
            }, $orders);
        } catch (DBALException $e) {
            $orders = [];
        }

        return $this->renderTemplate("orders/ajax_load", [
            "orderFilter" => $orderFilter,
            "orders" => $orders,
        ]);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function clone(): void
    {
        $order = (new OrderRepository())->findOneById($this->request->query->getInt("id"));
        if (count($order) == 0) {
            throw new ResourceNotFoundException();
        }

        $orderDto = new OrderDto();
        $orderDto->orderNumber = $order["order_number"];
        $orderDto->price = $order["price"];
        $orderDto->countProduct = $order["count_product"];
        $orderDto->orderDate = (new \DateTimeImmutable())->format("Y-m-d H:i:s");
        $orderDto->orderUsername = $order["order_username"];
        $orderDto->orderInformation = $order["order_information"];
        $orderDto->tel = $order["tel"];
        $orderDto->email = $order["email"];
        $orderDto->address = $order["address"];
        $orderDto->city = $order["city"];
        $orderDto->street = $order["street"];
        $orderDto->house = $order["house"];
        $orderDto->podezd = $order["podezd"];
        $orderDto->floor = $order["floor"];
        $orderDto->apartment = $order["apartment"];
        $orderDto->domofon = $order["domofon"];
        $orderDto->sales = $order["sales"];
        $orderDto->message = $order["message"];
        $orderDto->countPersons = $order["count_persons"];
        $orderDto->surrender = $order["surrender"];
        $orderDto->courierName = $order["courier_name"];

        $connect = (new Connect())->connect();

        $connect->beginTransaction();
        try {
            $createOrder = new CreateOrder($this->request);
            $createOrder->create($orderDto);
            $createOrder->addStatistic((new ParserInformation())->stringToArray($orderDto->orderInformation)["products"]);
            $connect->update("`order`", ["status" => OrderDto::STATUS["clone"]], ["id" => $order["id"]]);
            $connect->commit();
        } catch (DBALException $e) {
            $connect->rollBack();
        }

        $this->redirect();
    }
}
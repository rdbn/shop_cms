<?php

use App\Controller\OrderController;
use App\Controller\SecurityController;
use App\Controller\ProductController;
use App\Services\Logger;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

require __DIR__ . '/vendor/autoload.php';

$log = (new Logger('main'))->getLogger();

$session = new Session();
$session->start();

$request = Request::createFromGlobals();
$request->setSession($session);

$routes = new RouteCollection();
$routes->add('orders', new Route('/', [
    '_controller' => OrderController::class,
    'method' => 'orders'
]));

$routes->add('create_orders', new Route('/order/create', [
    '_controller' => OrderController::class,
    'method' => 'create'
]));

$routes->add('edit_orders', new Route('/order/edit', [
    '_controller' => OrderController::class,
    'method' => 'edit'
]));

$routes->add('change_status', new Route('/order/change-status', [
    '_controller' => OrderController::class,
    'method' => 'changeStatus'
]));

$routes->add('search_product', new Route('/product/search', [
    '_controller' => ProductController::class,
    'method' => 'search'
]));

$routes->add('login', new Route('/login', [
    '_controller' => SecurityController::class,
    'method' => 'login'
]));

$routes->add('registration', new Route('/registration', [
    '_controller' => SecurityController::class,
    'method' => 'registration'
]));

$context = new RequestContext('/');
$context->fromRequest($request);

try {
    $matcher = new UrlMatcher($routes, $context);
    $parameters = $matcher->match($context->getPathInfo());

    $controller = new $parameters["_controller"]($request);
    /** @var Response $response */
    $response = $controller->{$parameters["method"]}();
    $response->send();
} catch (ResourceNotFoundException $e) {
    $log->error($e->getMessage());
    $response = new Response("404 not found", 404);
    $response->send();
} catch (\Exception $e) {
    $log->error($e->getMessage());
    $response = new Response($e->getMessage(), 500);
    $response->send();
}

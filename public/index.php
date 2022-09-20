<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;
use App\Middleware\corsMiddleware;
require __DIR__.'/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

// CORS
$app->options("/{routes:.+}", function (ServerRequestInterface $request, ResponseInterface $response) {
    $response->getBody()->write("OK");
    return $response;
});

// CORS Headers
$app->add(corsMiddleware::class);
$app -> get('/', function ($request, $response, array $args) {
	$response->getBody() -> write(include "main.php");
	return $response -> withStatus(200);
});
$app->group("/order", function (RouteCollectorProxy $group) {
    $group->post('/add', 'App\Controllers\OrderControllers:add');
});

$app->run();

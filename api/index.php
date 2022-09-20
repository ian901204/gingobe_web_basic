<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use API\Middleware\corsMiddleware;
require __DIR__.'/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
// This middleware will append the response header Access-Control-Allow-Methods with all allowed methods
$app->options("/{routes:.+}", function (ServerRequestInterface $request, ResponseInterface $response) {
    $response->getBody()->write("OK");
    return $response;
});
$app->add(corsMiddleware::class);

// The RoutingMiddleware should be added after our CORS middleware so routing is performed first
$app->addRoutingMiddleware();
$app -> get('/', function ($request, $response, array $args) {
	$response->getBody() -> write(include "blank.php");
	return $response -> withStatus(200);
});
$app -> get('/order', function ($request, $response) {
	$response->getBody() -> write(include "order.php");
	return $response -> withStatus(200);
});

$app->run();

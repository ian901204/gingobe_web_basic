<?php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
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

$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response){
    $response->getBody()->write('List all users');
    return $response;
});



$app->run();

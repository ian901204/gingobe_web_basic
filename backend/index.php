<?php
use Slim\Factory\AppFactory;

require __DIR__.'/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://mysite')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
$app -> get('/', function ($request, $response, array $args) {
	$response->getBody() -> write(include "blank.php");
	return $response -> withStatus(200);
});
$app -> get('/order', function ($request, $response) {
	$response->getBody() -> write(include "order.php");
	return $response -> withStatus(200);
});

$app->run();

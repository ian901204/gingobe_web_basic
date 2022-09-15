<?php
use Slim\Factory\AppFactory;

require __DIR__.'/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->get('/', function ($request, $response, array $args) {
	$response->getBody() -> write(include "order.php");
	return $response -> withStatus(200);
});

$app->run();

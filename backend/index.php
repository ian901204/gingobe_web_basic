<?php
use Slim\Factory\AppFactory;

require __DIR__.'/../vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->get('/', function ($request, $response, array $args) {
	return $response->getBody() -> write("hi");
	 });

$app->run();

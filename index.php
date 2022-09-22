<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Slim\Routing\RouteContext;
require __DIR__.'/vendor/autoload.php';

$app = AppFactory::create();
$app->addErrorMiddleware(true, true, true);

// CORS
$app->options("/{routes:.+}", function (ServerRequestInterface $request, ResponseInterface $response) {
    $response->getBody()->write("OK");
    return $response;
});

// CORS Headers
$app->add(corsMiddleware::class);


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dbSettings = [
    "driver" => "mysql",
    "host" => $_ENV["DB_HOST"],
    "database" => $_ENV["DB_NAME"],
    "username" => $_ENV["DB_USER"],
    "password" => $_ENV["DB_PASSWORD"],
    "charset" => "utf8",
    "collation" => "utf8_unicode_ci",
    "prefix" => "",
];
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($dbSettings);
$capsule->bootEloquent();
$capsule->setAsGlobal();

$app -> get("/",  function (ServerRequestInterface $request, ResponseInterface $response) {
    $response -> getBody() -> write(include __DIR__."/backend/blank.php");
    return $response -> withStatus(200);
});

$app->group("/order", function (RouteCollectorProxy $group) {
    $group -> get("/", function (ServerRequestInterface $request, ResponseInterface $response){
        $response -> getBody() -> write(include __DIR__."./backend/order.php");
        return $response -> withStatus(200);
    });
    $group->post('/add', 'App\Controllers\OrderController:add');
});
$app->run();

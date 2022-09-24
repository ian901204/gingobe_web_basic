<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use App\Middlewares\corsMiddleware;
use App\Models\DB\Order;
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


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/..");
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

$app -> get("/",  function (Request $request, Response $response) {
    $response -> getBody() -> write(include "blank.php");
    return $response -> withStatus(200);
});


$app -> get("/login",  function (Request $request, Response $response) {
    $response -> getBody() -> write(include "login.php");
    return $response -> withStatus(200);
});

$app -> post("/login", "App\Controllers\AuthController:login");

$app -> group("/order", function (RouteCollectorProxy $group) {
    $group -> get("/list", 'App\Controllers\OrderController:list');
    
    $group -> post('/add', 'App\Controllers\OrderController:add');

    $group -> get("/delete/{id}", 'App\Controllers\OrderController:delete');
});
$app->run();

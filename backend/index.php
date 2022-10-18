<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use App\Middlewares\corsMiddleware;
use App\Middlewares\authMiddleware;

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

//暫時的測試頁面
$app -> get("/",  function (Request $request, Response $response) {
    include __DIR__."/common_component/blank.php";
    return $response -> withStatus(200);
});

//後台 token 認證 API
$app -> post("/verify", "App\Controllers\AuthController:verify");

//後台登入頁面
$app -> get("/login",  function (Request $request, Response $response) {
    include __DIR__."/login.php";
    return $response -> withStatus(200);
});

//後台登入API
$app -> post("/login", "App\Controllers\AuthController:login");

//前端頁面取得資訊用API
$app -> group("/frontend", function (RouteCollectorProxy $group){
    $group -> post("/product", "App\Controllers\ProductController:get_select");
    $group -> post("/seller", "App\Controllers\SellerController:select");
});

//產品選項區域
$app -> group("/product", function (RouteCollectorProxy $group){
    $group -> get("/add", function (Request $request, Response $response){
        include __DIR__."/product/product_add.php";
        return $response -> withStatus(200);
    });

    $group -> post("/edit", "App\Controllers\ProductController:edit");

    $group -> get("/list", "App\Controllers\ProductController:list");

    $group -> get("/get/{size}", "App\Controllers\ProductController:get");

    $group -> get("/queue", "App\Controllers\ProductController:queue_list");

    $group -> post("/delete/{id}", "App\Controllers\ProductController:delete")-> add(authMiddleware::class);

    $group -> post("/add", "App\Controllers\ProductController:add")-> add(authMiddleware::class);

    $group -> post("/queue", "App\Controllers\ProductController:queue")-> add(authMiddleware::class);
});

//業務員功能區域
$app -> group("/seller", function (RouteCollectorProxy $group){

    $group -> get("/add", function (Request $request, Response $response){
        include __DIR__."/seller/seller_add.php";
        return $response -> withStatus(200);
    });

    $group -> get("/list", "App\Controllers\SellerController:list");

    $group -> get("/get/{id}", "App\Controllers\SellerController:get");

    $group -> post("/add", "App\Controllers\SellerController:add")-> add(authMiddleware::class);
    
    $group -> post("/edit/{id}", "App\Controllers\SellerController:edit")-> add(authMiddleware::class);
    
    $group -> post("/delete/{id}", "App\Controllers\SellerController:delete")-> add(authMiddleware::class);
});

//訂單功能區域
$app -> group("/order", function (RouteCollectorProxy $group) {

    $group -> get("/list", 'App\Controllers\OrderController:list');

    $group -> get('/get/{id}', 'App\Controllers\OrderController:get');

    $group -> post('/add', 'App\Controllers\OrderController:add') -> add(authMiddleware::class);

    $group -> post("/edit/{id}", "App\Controllers\OrderController:edit") -> add(authMiddleware::class);

    $group -> post("/delete/{id}", 'App\Controllers\OrderController:delete') -> add(authMiddleware::class);
});

$app->run();

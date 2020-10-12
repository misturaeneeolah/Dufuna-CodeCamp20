<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../');
$dotenv->load();

require __DIR__ . '/../src/db.php';
require __DIR__ . '/../src/JsonBodyParserMiddleware.php';
require __DIR__ . '/../app/controllers/UserController.php';

// Instantiate app
$app = AppFactory::create();

require __DIR__ . '/../src/routes.php';

// Add route callbacks
$app->get('/', function (Request $request, Response $response) {
    $response->getBody()->write('Slim Application');
    return $response;
});

$products = [
    1 => ['id' => 1, "name" => "Cell phone", "price" => "$150"],
    2 => ['id' => 2, "name" => "car",  "price" => "$45,500"],
    3 => ['id' => 3, "name" => "Television",  "price" => "$1,500"]
];

$app->get('/products', function (Request $request, Response $response, $args) use ($products) {
    $payload = json_encode($products);
    $response->getBody()->write($payload);
    return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

$app->get('/products/{id}', function (Request $request, Response $response, $args) use ($products) {
    $id = $args['id'];
    if (!array_key_exists($id, $products)) {
        $response->getBody()->write("Product not found");
        return $response->withStatus(404);
    }
    $product= $products[$id];
    $response->getBody()->write(json_encode($product));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
});

// Run application
$app->run();
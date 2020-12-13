<?php

require __DIR__ . '/vendor/autoload.php';

use CoffeeCode\Router\Router;

$router = new Router(BASE_URL);

$router->namespace('App\Controllers');

$router->group(null);
$router->get('/', 'HomeController:index');

$router->group('products');
$router->get('/products', 'HomeController:products');


$router->get('/product-types', 'HomeController:productTypes');

$router->dispatch();

if ($router->error()) {
    die("router error");
}
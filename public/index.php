<?php

declare(strict_types=1);

use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

use App\Http\Router;

$dotenv = Dotenv::createImmutable(__DIR__.'/..');
$dotenv->safeLoad();

$router = new Router();

require_once __DIR__ .'/../Controller/routes.php';

try {
    $router->dispatch();
} catch (JsonException $e) {
    echo $e->getMessage();
}

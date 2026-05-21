<?php

declare(strict_types=1);

use App\Http\Router;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

$dotenv = Dotenv::createImmutable(__DIR__.'/..');
$dotenv->safeLoad();

$router = new Router();

require_once __DIR__ .'/../src/Controller/routes.php';

try {
    $router->dispatch();
} catch (JsonException $e) {
    echo $e->getMessage();
}

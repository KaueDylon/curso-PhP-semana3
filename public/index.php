<?php

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

use \App\Http\Router;

$router = new Router();

$dotenv = Dotenv::createImmutable(__DIR__.'/..');
$dotenv->safeLoad();

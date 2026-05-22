<?php

declare(strict_types=1);
namespace App\Controller;

use App\Controller\ContatoController;

/** @var Router $router */
// ROTA DE CONTATOS ::

$router->get('/usuario', [ContatoController::class, 'usuario']);
$router->get('/usuario/{id}', [ContatoController::class, 'usuarioPorId']);
$router->post('/usuario', [ContatoController::class, 'inserirUsuario']);

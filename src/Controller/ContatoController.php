<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ContatoService;
class ContatoController
{
    private ContatoService $service;

    public function __construct()
    {
        $this->service = new ContatoService();
    }

    public function usuario(array $params = []): array
    {
        return $this->service->listarTodos();
    }

    public function inserirUsuario(array $params = [], array $body = []): void // ## ARRUMAR DEPOIS ##
    {
        $this->service->criarContato($body);
    }

    public function usuarioPorId(array $params = []): array
    {
        return $this->service->listarPorId($params);
    }


}

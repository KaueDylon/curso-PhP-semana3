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

    public function usuario(): array
    {
        return $this->service->listarTodos();
    }


}

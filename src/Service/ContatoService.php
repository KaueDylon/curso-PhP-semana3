<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\ContatoRepository;

class ContatoService
{

    private ContatoRepository $repository;

    public function __construct()
    {
        $this->repository = new ContatoRepository();
    }

    public function listarTodos(): array
    {
        return $this->repository->buscarTodos();
    }

}
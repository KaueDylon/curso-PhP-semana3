<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\CriarContatoModel;
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

    public function criarContato(array $body): void // ## ARRUMAR DEPOIS ##
    {
        try {
            $nome = $body['nome'];
            $email = $body['email'];
            $telefone = $body['telefone'];

            if( (is_null($nome)) || (is_null($email)) || (is_null($telefone)) ){
                throw new \InvalidArgumentException();
            }

        }catch (\InvalidArgumentException $e){
            return;
        }

        $contato = new CriarContatoModel($nome, $email, $telefone) ;

        $this->repository->adicionarNovoContato($contato);
    }

}
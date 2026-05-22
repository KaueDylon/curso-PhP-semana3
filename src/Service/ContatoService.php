<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\CriarContatoModel;
use App\Repository\ContatoRepository;
use App\Utils\TelefoneRegex;

class ContatoService
{

    private ContatoRepository $repository;

    public function __construct()
    {
        $this->repository = new ContatoRepository();
    }

    public function listarTodos(): array
    {

        $contatos = $this->repository->buscarTodos();

        for ($i = 0; $i < count($contatos); $i++) {
            $telefonePuro = $contatos[$i]['telefone'];
            $telefoneFormat = TelefoneRegex::formatarTelefone((string)$telefonePuro);
            $contatos[$i]['telefone'] = $telefoneFormat;
        }
        return $contatos;

    }

    public function listarPorId(array $params): array
    {
        try {
            $id = (int)($params['id']);

            if($id == ''){
                throw new \InvalidArgumentException();
            }
        }catch (\InvalidArgumentException $e){
//            return;
        }

        $contato = $this->repository->buscarPorId($id); // FORMATAR O QUE VEM EM CONTRATO

        $telefonePuro = $contato['telefone'];
        $telefoneFormat = TelefoneRegex::formatarTelefone((string)$telefonePuro);

        $contato['telefone'] = $telefoneFormat;

        http_response_code(200);
        return $contato;
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

        http_response_code(201);
        $this->repository->adicionarNovoContato($contato);
    }

    public function deletarContato(array $params): void
    {
        try {
            $id = (int)($params['id']);

            if($id == ''){
                throw new \InvalidArgumentException();
            }
        }catch (\InvalidArgumentException $e){
//            return;
        }

        $this->repository->deletarContatoPorId($id);

    }

}
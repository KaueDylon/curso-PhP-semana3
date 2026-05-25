<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\ContatoModel;
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
        $id = filter_var($params['id'] ?? null, FILTER_VALIDATE_INT);

        if(!$id){
            throw new \InvalidArgumentException('ID inválido ou vázio');
        }

        $contato = $this->repository->buscarPorId($id);

        if (!$contato){
            throw new \RuntimeException('Contato não foi encontrado');
        }

        $telefonePuro = $contato['telefone'];
        $telefoneFormat = TelefoneRegex::formatarTelefone((string)$telefonePuro);
        $contato['telefone'] = $telefoneFormat;

        return $contato;
    }

    public function criarContato(array $body): void
    {
            $nome = $body['nome'] ?? null;
            $email = $body['email'] ?? null;
            $telefone = $body['telefone'] ?? null;

            if( (empty($nome)) || (empty($email)) || (empty($telefone)) ){
                throw new \InvalidArgumentException("Todos ou algum campo não foi preenchido corretamente.");
            }

        $contato = new ContatoModel($nome, $email, (int)$telefone) ;

        $this->repository->adicionarNovoContato($contato);
    }

    public function deletarContato(array $params): void
    {

        $id = filter_var($params['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id){
            throw new \InvalidArgumentException('ID inválido para a exclusão');
        }

        $contato = $this->repository->buscarPorId($id);

        if(!$contato || !$contato['status'] ){                                 # ARRUMAR ESSA EXCEÇÃO DEPOIS DO ALMOÇO !!!
            throw new \RuntimeException('Contato não existe para uma exclusão.');
        }

        $this->repository->deletarContatoPorId($id);

    }


    public function restaurarContato(array $params): void
    {

        $id = filter_var($params['id'] ?? null, FILTER_VALIDATE_INT);

        if (!$id){
            throw new \InvalidArgumentException('ID inválido para a exclusão');
        }

        $contato = $this->repository->buscarDeletadorPorId($id);

        if(!$contato){
            throw new \RuntimeException('Contato não existe para uma restauração.');
        }

        if($contato['status']){
            throw new \RuntimeException('Contato já está ativo e não precisa ser restaurado.');
        }


        $this->repository->restaurarContatoPorId($id);

    }

    public function editarContato(array $params, array $body): void
    {

        $id = filter_var($params['id'] ?? null, FILTER_VALIDATE_INT);

        if(!$id){
            throw new \InvalidArgumentException('ID inválido para a edição');
        }

        $contatoExistente = $this->repository->buscarPorId($id);

        if(!$contatoExistente){
            throw new \RuntimeException('Contato não foi encontrado para edição');
        }

        $contatoNome = $body['nome'] ?? $contatoExistente['nome'];
        $contatoEmail = $body['email'] ?? $contatoExistente['email'];
        $contatoTelefone = (int)$body['telefone'] ?? (int)$contatoExistente['telefone'];;

        $contatoEditar = new ContatoModel($contatoNome, $contatoEmail, $contatoTelefone, $id);

        $this->repository->editarContatoPorId($contatoEditar);

    }

}
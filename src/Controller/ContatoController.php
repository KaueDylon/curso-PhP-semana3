<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ContatoService;
use http\Exception\RuntimeException;

class ContatoController
{
    private ContatoService $service;

    public function __construct()
    {

        $this->service = new ContatoService();
    }

    public function usuario(array $params = [], array $body = []): array
    {

        try {
            $resultado = $this->service->listarTodos();

            http_response_code(200);

          return [
                'sucesso' => true,
                'info' => $resultado
            ];
        }catch (\InvalidArgumentException $e){

            http_response_code(400);

            return [
                'sucesso' => false,
                'info' => $e->getMessage()
            ];

        }catch (\RuntimeException $e){
            http_response_code(400);

            return [
                'sucesso' => false,
                'info' => $e->getMessage()
            ];
        }

    }

    public function inserirUsuario(array $params = [], array $body = []): array // ## ARRUMAR DEPOIS ##
    {

        try {
            $this->service->criarContato($body);

            http_response_code(201);
            return [
                'sucesso' => true,
                'info' => 'Contato criado com sucesso.'
            ];
        } catch (\InvalidArgumentException $e){
            http_response_code(400);
            return [
                'sucesso' => false,
                'info' => $e->getMessage()
            ];
        } catch (\RuntimeException $e){
            http_response_code(400);
            return [
                'sucesso' => false,
                'info' => $e->getMessage()
            ];
        }
    }

    public function usuarioPorId(array $params = [], array $body = []): array
    {

        try {
            $resultado = $this->service->listarPorId($params);

            http_response_code(200);
            return [
                'sucesso' => true,
                'info' => $resultado
            ];
        }catch (\InvalidArgumentException $e){
            http_response_code(400);
            return [
                'sucesso' => false,
                'info' => $e->getMessage()
            ];
        }catch (\RuntimeException $e){
            http_response_code(404);
            return [
                'sucesso' => false,
                'info' => $e->getMessage()
            ];
        }

    }

    public function deletarContatoPorId(array $params = [], array $body = []): array
    {
        try {
            $this->service->deletarContato($params);

            http_response_code(200);
            return [
                'sucesso' => true,
                'info' => 'Contato foi deletado com sucesso.'
            ];
        } catch (\InvalidArgumentException $e){
            http_response_code(400);
            return [
                'sucesso' => false,
                'info' => $e->getMessage()
            ];
        }catch (\RuntimeException $e){
            http_response_code(404);
            return [
                'sucesso' => false,
                'info' => $e->getMessage()
            ];
        }
    }

    public function restaurarContatoPorId(array $params = [], array $body = []): array
    {
        try {
            $this->service->restaurarContato($params);

            http_response_code(204);
            return [
                'sucesso' => true,
                'info' => 'Contato foi restaurado com sucesso.'
            ];
        } catch (\InvalidArgumentException $e){
            http_response_code(400);
            return [
                'sucesso' => false,
                'info' => $e->getMessage()
            ];
        }catch (\RuntimeException $e){
            http_response_code(404);
            return [
                'sucesso' => false,
                'info' => $e->getMessage()
            ];
        }
    }

    public function editarContatoPorId(array $params = [], array $body = []): array
    {
        try {
            $this->service->editarContato($params, $body);

            http_response_code(200);
            return [
                'sucesso' => true,
                'info' => 'Contato foi atualizado com sucesso.'
            ];
        }catch (\InvalidArgumentException $e){
            http_response_code(400);
            return [
                'sucesso' => false,
                'info' => $e->getMessage()
            ];
        }catch (\RuntimeException $e){
            http_response_code(404);
            return [
                'sucesso' => false,
                'info' => $e->getMessage()
            ];
        }
    }


}

<?php

declare(strict_types=1);

namespace App\Repository;

use App\Config\Database;
use App\Model\ContatoModel;
use PDO;

class ContatoRepository
{
    private PDO $PDO;

    public function __construct()
    {
        $this->PDO = Database::getConnection();
    }

    public function buscarTodos(): array
    {
        $stmt = $this->PDO->query('SELECT * FROM contatos WHERE status = TRUE');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId(int $id): array
    {
        $stmt = $this->PDO->prepare('SELECT * FROM contatos WHERE id = :id AND status = TRUE');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function deletarContatoPorId(int $id): void
    {
        $stmt = $this->PDO->prepare('UPDATE contatos SET status = false WHERE id = :id');
        $stmt->execute([':id' => $id]);

        http_response_code(204);
    }

    public function editarContatoPorId(ContatoModel $contato)
    {
        $stmt = $this->PDO->prepare('UPDATE contatos SET nome = :nome, email = :email, telefone = :telefone  WHERE id = :id');
        $stmt->execute([':id' => $contato->getId(),
                ':nome' => $contato->getNome(),
                ':email' => $contato->getEmail(),
                ':telefone' => $contato->getTelefone(),

            ]);

        http_response_code(204);
    }

    public function adicionarNovoContato(ContatoModel $contato)
    {
        $stmt = $this->PDO->prepare(
            "INSERT INTO contatos (nome, email, telefone) 
                    VALUES (:nome, :email, :senha)");
        $stmt->execute([
            ':nome' => $contato->getNome(),
            ':email' => $contato->getEmail(),
            ':senha' => $contato->getTelefone(),

        ]);
    }

}
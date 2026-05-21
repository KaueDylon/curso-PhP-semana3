<?php

namespace App\Repository;

use App\Config\Database;
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
        $stmt = $this->PDO->query('SELECT * FROM contatos');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
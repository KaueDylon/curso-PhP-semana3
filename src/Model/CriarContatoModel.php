<?php


namespace App\Model;
class CriarContatoModel
{
    public function __construct(
        private string $nome,
        private string $email,
        private string $telefone
    )
    {
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getTelefone(): int
    {
        return $this->telefone;
    }

    public function setTelefone(int $telefone): void
    {
        $this->telefone = $telefone;
    }

}

# API de Contatos - PHP Puro

API RESTful desenvolvida em PHP puro utilizando arquitetura em camadas (`Controller`, `Service`, `Repository`, `Model`) e gerenciamento de dependências com Composer.

O projeto realiza operações CRUD de contatos com suporte a:

- Listagem de contatos
- Busca por ID
- Criação de contato
- Edição de contato
- Exclusão lógica (soft delete)
- Restauração de contatos deletados
- Formatação automática de telefone
- Variáveis de ambiente com `.env`
- Router próprio em PHP

---

# Tecnologias utilizadas

- PHP 8+
- Composer
- PDO
- MySQL
- vlucas/phpdotenv (para arquivos .env)

---

# Estrutura do projeto

```bash
project/
│
├── public/
│   └── index.php
│
├── src/
│   ├── Config/
│   │   └── Database.php
│   │
│   ├── Controller/
│   │   ├── ContatoController.php
│   │   └── routes.php
│   │
│   ├── Http/
│   │   └── Router.php
│   │
│   ├── Model/
│   │   └── ContatoModel.php
│   │
│   ├── Repository/
│   │   └── ContatoRepository.php
│   │
│   ├── Service/
│   │   └── ContatoService.php
│   │
│   └── Utils/
│       └── TelefoneRegex.php
│
├── vendor/
├── .env
├── composer.json
└── README.md
````

---

# Instalação

## 1. Clone o projeto

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
```

---

## 2. Instale as dependências

```bash
composer install
```

---

## 3. Configure o `.env`

Crie um arquivo `.env` na raiz do projeto:

```env
DB_DSN=mysql:host=localhost;dbname=contactapi;
DB_NAME=(seu_usuario)
DB_PASSWORD=(sua_senha)
```

---

# Estrutura do Banco

```sql

CREATE DATABASE contactapi;

CREATE TABLE contatos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefone BIGINT NOT NULL,
    status BOOLEAN DEFAULT TRUE
);
```

---

# Executando o projeto

Utilize o servidor embutido do PHP:

```bash
php -S localhost:8000 -t public
```

A API ficará disponível em:

```bash
http://localhost:8000
```

---

# Rotas da API

## Buscar todos os contatos

```http
GET /usuario
```

### Resposta

```json
{
  "sucesso": true,
  "info": [
    {
      "id": 1,
      "nome": "João",
      "email": "joao@email.com",
      "telefone": "(47) 99999-9999"
    }
  ]
}
```

---

## Buscar contato por ID

```http
GET /usuario/{id}
```

### Exemplo

```http
GET /usuario/1
```

---

## Criar contato

```http
POST /usuario
```

### Body

```json
{
  "nome": "Maria",
  "email": "maria@email.com",
  "telefone": "47999999999"
}
```

---

## Atualizar contato

```http
PUT /usuario/{id}
```

### Body

```json
{
  "nome": "Maria Silva",
  "email": "mahSilva@email.com",
  "telefone": "47988888888"
}
```

---

## Deletar contato (Soft Delete)

```http
DELETE /usuario/{id}
```

O contato não é removido do banco, apenas marcado como inativo.

---

## Restaurar contato

```http
PATCH /usuario/{id}
```

Restaura um contato deletado logicamente.

---

# Recursos implementados

* Strict Types
* Prepared Statements
* Validação de ID
* Tratamento de exceções
* Soft Delete
* Singleton de conexão PDO
* Formatação automática de telefone com regex

---


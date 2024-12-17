<?php

namespace App\Infrastructure\Repository;

use App\Domain\TodoRepository;
use App\Domain\TodoId;
use App\Domain\Todo;
use App\Application\ReadModel\TodosRepository;
use App\Application\ReadModel\OpenedTodo;
use Doctrine\DBAL\Connection;

final class PostgresTodoRepository implements TodoRepository, TodosRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function get(TodoId $id): ?Todo
    {
        $query = 'SELECT * FROM todos WHERE id = :id';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue('id', $id->asString());
        $data = $stmt->executeQuery()->fetchAssociative();

        return $data ? Todo::fromData($data) : null;
    }

    public function save(Todo $todo): void
    {
        $query = 'INSERT INTO todos (id, description, status) VALUES (:id, :description, :status)
                  ON CONFLICT (id) DO UPDATE SET description = :description, status = :status';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue('id', $todo->id()->asString());
        $stmt->bindValue('description', $todo->toData()['description']); // Accéder directement aux données du Todo 
        $stmt->bindValue('status', $todo->toData()['status']); // Accéder directement aux données du Todo 
        $stmt->executeStatement();
    }

    public function opened(): array
    {
        $query = 'SELECT * FROM todos WHERE status = :status';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue('status', 'opened');
        $data = $stmt->executeQuery()->fetchAllAssociative();

        $todos = [];
        foreach ($data as $item) {
            $todo = new OpenedTodo();
            $todo->id = $item['id'];
            $todo->description = $item['description'];
            $todos[] = $todo;
        }

        return $todos;
    }
}

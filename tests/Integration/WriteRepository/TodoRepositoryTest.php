<?php
declare(strict_types=1);

namespace App\Tests\Integration\WriteRepository;

use App\Domain\CannotCloseTodo;
use App\Domain\Todo;
use App\Domain\TodoDescription;
use App\Domain\TodoId;
use App\Domain\TodoRepository;
use App\Infrastructure\Repository\InMemoryTodoRepository;
use PHPUnit\Framework\TestCase;
use function App\Tests\Fixtures\aTodo;
use App\Infrastructure\Repository\PostgresTodoRepository;

require_once __DIR__ . '/../../../vendor/autoload.php';


final class TodoRepositoryTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideConcretions
     */
    public function it_saves_non_existing_todo(TodoRepository $repository): void
    {
        $aNonExistingTodo = aTodo()->build();

        $repository->save($aNonExistingTodo);

        $this->assertEquals($aNonExistingTodo, $repository->get($aNonExistingTodo->id()));
    }

    /**
     * @test
     * @dataProvider provideConcretions
     */
    public function it_saves_existing_todo(TodoRepository $repository): void
    {
        $anExistingTodo = aTodo()->savedIn($repository);

        $repository->save($anExistingTodo);

        $this->assertEquals($anExistingTodo, $repository->get($anExistingTodo->id()));
    }

    public static function provideConcretions(): \Generator
    {
        // Load the .env file 
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../../../'); 
        $dotenv->load();

        // Configuration de la connexion PostgreSQL
        $connectionParams = [ 
            'url' => $_ENV['DATABASE_URL'], 
            'driver' => 'pdo_pgsql', 
            'host' => 'db', 
            'port' => 5432, 
            'user' => 'florian', 
            'password' => 'flodev', 
            'dbname' => 'todo_list',
        ];
        $connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
    
        yield InMemoryTodoRepository::class => [new InMemoryTodoRepository()];
        yield PostgresTodoRepository::class => [new PostgresTodoRepository($connection)];
    }    
}

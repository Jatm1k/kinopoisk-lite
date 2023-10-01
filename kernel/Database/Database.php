<?php

namespace App\Kernel\Database;

use App\Kernel\Config\ConfigInterface;

class Database implements DatabaseInterface
{
    private \PDO $pdo;

    public function __construct(
        private ConfigInterface $config,
    ) {
        $this->connect();
    }

    public function insert(string $table, array $data): int|false
    {
        $fields = array_keys($data);
        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn ($field) => ":$field", $fields));

        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";

        $query = $this->pdo->prepare($sql);

        try {
            $query->execute($data);
        } catch (\PDOException) {
            return false;
        }

        return $this->pdo->lastInsertId();
    }

    public function first(string $table, array $conditions = []): ?array
    {
        $where = '';

        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "SELECT * FROM $table $where LIMIT 1";

        $query = $this->pdo->prepare($sql);
        $query->execute($conditions);
        $result = $query->fetch(\PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function get(string $table, array $conditions = [], array $order = [], int $limit = -1): ?array
    {
        $where = '';

        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "SELECT * FROM $table $where";

        if (count($order) > 0) {
            $sql .= ' ORDER BY '.implode(', ', array_map(fn ($field, $direction) => "$field $direction", array_keys($order), $order));
        }
        if ($limit > 0) {
            $sql .= " LIMIT $limit";
        }

        $query = $this->pdo->prepare($sql);
        $query->execute($conditions);
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    public function delete(string $table, array $conditions = []): bool
    {
        $where = '';

        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "DELETE FROM $table $where";

        $query = $this->pdo->prepare($sql);

        return $query->execute($conditions);
    }

    public function update(string $table, array $data, array $conditions = []): void
    {
        $set = implode(', ', array_map(fn ($field) => "$field = :$field", array_keys($data)));

        $where = '';

        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "UPDATE $table SET $set $where";

        $query = $this->pdo->prepare($sql);

        $query->execute(array_merge($data, $conditions));
    }

    private function connect(): void
    {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');

        try {
            $this->pdo = new \PDO(
                "$driver:host=$host;port=$port;dbname=$database;charset=$charset",
                $username,
                $password
            );
        } catch (\PDOException $exception) {
            exit("Ошибка подключения к базе данных: {$exception->getMessage()}");
        }
    }
}

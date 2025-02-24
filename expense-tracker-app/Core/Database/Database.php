<?php
namespace Core\Database;
use PDO;

class Database {
    public $connection;
    public $statement;

    public function __construct($config) {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
        try {
            $this->connection = new PDO($dsn, "root", "root", [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (\PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
        }
    }

    public function query($query, $parameters = []) {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($parameters);
        return $this;
    }

    public function find() {
        return $this->statement->fetch();
    }

    public function findAll() {
        return $this->statement->fetchAll();
    }

    public function rowCount() {
        return $this->statement->rowCount();
    }

    public function fetchColumn() {
        return $this->statement->fetchColumn();
    }
    public function lastInsertId() {
        return $this->connection->lastInsertId(); // ✅ Fixed!
    }
}

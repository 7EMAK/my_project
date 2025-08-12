<?php

namespace config;

use PDO;
use PDOException;

class Database
{
    private string $host = "mysql";
    private string $port = "3306";
    private string $user = "user";
    private string $pass = "secret";
    private string $dbname = "mydb";
    public ?PDO $conn;

    public function getConnection(): PDO|null
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8mb4",
                $this->user,
                $this->pass
            );
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $this->conn;
    }
}

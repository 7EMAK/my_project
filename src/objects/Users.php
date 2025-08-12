<?php

namespace objects;

use config\Database;
use PDO;

class Users
{
    private string $tableName = "users";
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $createdAt;
    public string $updatedAt;
    public ?PDO $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll(): false|\PDOStatement
    {
        $query = "SELECT first_name, last_name FROM " . $this->tableName;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    public function getOne(int $id): ?array
    {
        $query = "SELECT first_name, last_name FROM " . $this->tableName . " WHERE id = :id LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ?: null;
    }

    public function create(): bool
    {
        $query = "INSERT INTO " . $this->tableName . " 
              SET first_name = :first_name, last_name = :last_name";

        $stmt = $this->conn->prepare($query);

        // Очистим входные данные
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));

        // Привязываем значения
        $stmt->bindParam(":first_name", $this->firstName);
        $stmt->bindParam(":last_name", $this->lastName);

        return $stmt->execute();
    }

    public function update(): bool
    {
        $query = "UPDATE " . $this->tableName . "
              SET first_name = :first_name, last_name = :last_name, updatedAt = NOW()
              WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Очистка данных
        $this->firstName = htmlspecialchars(strip_tags($this->firstName));
        $this->lastName = htmlspecialchars(strip_tags($this->lastName));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Привязка значений
        $stmt->bindParam(':first_name', $this->firstName);
        $stmt->bindParam(':last_name', $this->lastName);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
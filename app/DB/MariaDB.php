<?php

namespace Bank\DB;

use App\DB\DataBase;
use PDO;


class MariaDB implements DataBase
{

    // function create(array $userData): void;
    // function update(int $userId, array $userData): void;
    // function delete(int $userId): void;
    // function show(int $userId): array;
    // function showAll(): array;

    private $table, $pdo;

    public function __construct($tableName)
    {
        $host = '127.0.0.1';
        $db   = 'iguanos';
        $user = 'root';
        $pass = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new PDO($dsn, $user, $pass, $options);
        $this->table = $tableName;
    }

    public function create(array $userData): void
    {
        if ($this->table == 'bankas') {
            $sql = "
            INSERT INTO {$this->table} (personalCode, firstName, lastName, accNumber, money)
            VALUES (?, ?, ?, ?, ?) 
        ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$userData['personalCode'], $userData['firstName'], $userData['lastName'], $userData['accNumber'], $userData['money']]);
        }
        if ($this->table == 'user') {
            $sql = "
            INSERT INTO {$this->table} (name, email, password, role)
            VALUES (?, ?, ?, ?) 
        ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$userData['name'], $userData['email'], $userData['password'], $userData['role']]);
        }
    }

    public function update(int $userId, array $userData): void
    {
        if ($this->table == 'bankas') {
            $sql = "
            UPDATE {$this->table}
            SET personalCode = ?, firstName = ?, lastName = ?, accNumber = ?, money = ?
            WHERE id = ?
        ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$userData['personalCode'], $userData['firstName'], $userData['lastName'], $userData['accNumber'], $userData['money'], $userId]);
        }
        if ($this->table == 'user') {
            $sql = "
            UPDATE {$this->table}
            SET name = ?, email = ?, password = ?, role = ?
            VALUES (?, ?, ?, ?) 
        ";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$userData['name'], $userData['email'], $userData['password'], $userData['role'], $userId]);
        }
    }

    public function delete(int $userId): void
    {
        $sql = "
            DELETE FROM {$this->table}
            WHERE id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);
    }

    public function show(int $userId): array
    {
        $sql = "
            SELECT id, personalCode, firstName, lastName, accNumber, money
            FROM {$this->table}
            WHERE id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetch();
    }

    public function showAll(): array
    {
        $sql = "
            SELECT *
            FROM {$this->table}
        ";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }
}

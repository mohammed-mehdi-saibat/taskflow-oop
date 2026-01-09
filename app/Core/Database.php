<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use Exception;
use PDOException;

class Database
{
    private static ?Database $instance = null;
    private PDO $connection;



    private function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=taskflow;charset=utf8mb4';
        $user = 'root';
        $pass = '';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->connection = new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            die("Database connection failed" . $e->getMessage());
        }
    }

    private function __clone() {}

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton");
    }

    public static function getInstance(): Database
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}

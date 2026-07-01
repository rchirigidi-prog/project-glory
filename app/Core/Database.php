<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private static ?Database $instance = null;

    private PDO $connection;

    private function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';

            $host = $config['host'];
            $database = $config['database'];
            $username = $config['username'];
            $password = $config['password'];
            $charset = $config['charset'];
        try {

            $this->connection = new PDO(

                "mysql:host={$host};dbname={$database};charset={$charset}",

                $username,

                $password

            );

            $this->connection->setAttribute(

                PDO::ATTR_ERRMODE,

                PDO::ERRMODE_EXCEPTION

            );

            $this->connection->setAttribute(

                PDO::ATTR_DEFAULT_FETCH_MODE,

                PDO::FETCH_ASSOC

            );

        } catch (PDOException $e) {

            throw new PDOException(
                "Database Connection Failed: " . $e->getMessage(),
                (int)$e->getCode(),
                $e
            );

        }
    }

    public static function getInstance(): Database
    {
        if (self::$instance === null) {

            self::$instance = new Database();

        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
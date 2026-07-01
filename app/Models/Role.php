<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Role
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll(): array
    {
        return $this->db
            ->query("SELECT id, name FROM roles ORDER BY name")
            ->fetchAll();
    }
}

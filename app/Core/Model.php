<?php

namespace App\Core;

use PDO;

abstract class Model
{
    protected PDO $db;

    protected string $table;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");

        return $stmt->fetchAll();
    }

    public function find(int $id)
    {
        $stmt = $this->db->prepare(

            "SELECT * FROM {$this->table} WHERE id = ?"

        );

        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function delete(int $id)
    {
        $stmt = $this->db->prepare(

            "DELETE FROM {$this->table} WHERE id = ?"

        );

        return $stmt->execute([$id]);
    }
}
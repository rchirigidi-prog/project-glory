<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Find a user by email address.
     */
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE email = :email LIMIT 1"
        );

        $stmt->execute([
            'email' => $email
        ]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    /**
     * Find a user by ID.
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE id = :id LIMIT 1"
        );

        $stmt->execute([
            'id' => $id
        ]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

/**
 * Get all users with role names.
 */
        public function getAllUsers(): array
        {
            $stmt = $this->db->query("
                SELECT
                    u.id,
                    u.name,
                    u.email,
                    u.status,
                    u.created_at,
                    r.name AS role_name
                FROM users u
                LEFT JOIN roles r
                    ON u.role_id = r.id
                ORDER BY u.id DESC
            ");

            return $stmt->fetchAll();
        }

    /**
     * Count all users.
     */
    public function countUsers(): int
    {
        return (int)$this->db->query(
            "SELECT COUNT(*) FROM users"
        )->fetchColumn();
    }

/**
 * Create a new user.
 */
public function create(array $data): bool
{
    $stmt = $this->db->prepare("
        INSERT INTO users
        (
            role_id,
            name,
            email,
            password,
            status
        )
        VALUES
        (
            :role_id,
            :name,
            :email,
            :password,
            :status
        )
    ");

    return $stmt->execute([
        'role_id'  => $data['role_id'],
        'name'     => $data['name'],
        'email'    => $data['email'],
        'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        'status'   => $data['status']
    ]);
}
   
/**
 * Check if an email already exists.
 */
public function emailExists(string $email): bool
{
    $stmt = $this->db->prepare("
        SELECT COUNT(*)
        FROM users
        WHERE email = :email
    ");

    $stmt->execute([
        'email' => $email
    ]);

    return $stmt->fetchColumn() > 0;
}

/**
 * Update an existing user.
 */
public function update(int $id, array $data): bool
{
    $stmt = $this->db->prepare("
        UPDATE users
        SET
            role_id = :role_id,
            name = :name,
            email = :email,
            status = :status,
            updated_at = NOW()
        WHERE id = :id
    ");

    return $stmt->execute([
        'id'      => $id,
        'role_id' => $data['role_id'],
        'name'    => $data['name'],
        'email'   => $data['email'],
        'status'  => $data['status']
    ]);
}

/**
 * Find user by ID with role.
 */
public function getUser(int $id): ?array
{
    $stmt = $this->db->prepare("
        SELECT *
        FROM users
        WHERE id = :id
        LIMIT 1
    ");

    $stmt->execute([
        'id' => $id
    ]);

    $user = $stmt->fetch();

    return $user ?: null;
}
}

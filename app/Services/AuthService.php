<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login(string $email, string $password): bool
    {

   $user = $this->userModel->findByEmail($email);

if (!$user) {
    return false;
}

if (!password_verify($password, $user['password'])) {
    return false;
}

session_regenerate_id(true);

$_SESSION['user_id'] = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_email'] = $user['email'];
$_SESSION['user_role_id'] = $user['role_id'];

return true;
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    public function check(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function userId(): ?int
    {
        return $_SESSION['user_id'] ?? null;
    }
}

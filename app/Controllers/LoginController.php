<?php

namespace App\Controllers;

use App\Services\AuthService;

class LoginController
{
    private AuthService $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($this->auth->login($email, $password)) {

            header("Location: /admin/dashboard.php");
            exit;

        }

        $_SESSION['login_error'] = "Invalid email or password.";

        header("Location: /admin/login.php");
        exit;
    }

    public function logout(): void
    {
        $this->auth->logout();

        header("Location: /admin/login.php");
        exit;
    }
}
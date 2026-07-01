<?php

namespace App\Controllers;

use App\Services\UserService;

class UserController
{
    private UserService $service;

    public function __construct()
    {
        $this->service = new UserService();
    }

    public function index(): array
    {
        return [
            'users' => $this->service->getUsers(),
            'total' => $this->service->getTotalUsers()
        ];
    }

    public function create(): array
    {
        return [
            'roles' => $this->service->getRoles()
        ];
    }

   public function store(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    if ($this->service->emailExists($_POST['email'])) {

        $_SESSION['error'] = "Email already exists.";

        header("Location: create.php");

        exit;
    }

    $this->service->createUser($_POST);

    $_SESSION['success'] = "User created successfully.";

    header("Location: index.php");

    exit;
}
public function edit(int $id): array
{
    return [
        'user'  => $this->service->getUser($id),
        'roles' => $this->service->getRoles()
    ];
}

public function update(int $id): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    $this->service->updateUser($id, $_POST);

    $_SESSION['success'] = "User updated successfully.";

    header("Location: index.php");

    exit;
}
}

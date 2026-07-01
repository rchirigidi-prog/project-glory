<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;

class UserService
{
    private User $userModel;
    private Role $roleModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->roleModel = new Role();
    }

    public function getUsers(): array
    {
        return $this->userModel->getAllUsers();
    }

    public function getTotalUsers(): int
    {
        return $this->userModel->countUsers();
    }

    public function getRoles(): array
    {
        return $this->roleModel->getAll();
    }

    public function createUser(array $data): bool
    {
        return $this->userModel->create($data);
    }

    public function emailExists(string $email): bool
    {
        return $this->userModel->emailExists($email);
    }

public function getUser(int $id): ?array
{
    return $this->userModel->getUser($id);
}

public function updateUser(int $id, array $data): bool
{
    return $this->userModel->update($id, $data);
}

}

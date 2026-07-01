<?php

require_once __DIR__ . '/../../../bootstrap/app.php';

use App\Controllers\UserController;
use App\Middleware\AuthMiddleware;

AuthMiddleware::handle();

$data = (new UserController())->index();

$users = $data['users'];
$total = $data['total'];

$success = $_SESSION['success'] ?? '';
unset($_SESSION['success']);

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-wrapper">

<?php require '../includes/navbar.php'; ?>

<div class="dashboard">

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Users</h2>

    <a href="create.php" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add User
    </a>
</div>

<div class="card shadow-sm">

<div class="card-body">

<?php if ($success): ?>

<div class="alert alert-success">
    <?= e($success) ?>
</div>

<?php endif; ?>

<p><strong>Total Users:</strong> <?= $total ?></p>

<table class="table table-striped table-hover align-middle">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Name</th>

<th>Email</th>

<th>Role</th>

<th>Status</th>

<th width="180">Actions</th>

</tr>

</thead>

<tbody>

<?php foreach ($users as $user): ?>

<tr>

<td><?= $user['id'] ?></td>

<td><?= e($user['name']) ?></td>

<td><?= e($user['email']) ?></td>

<td>

<span class="badge bg-primary">

<?= e($user['role_name']) ?>

</span>

</td>

<td>

<?php if ($user['status'] === 'Active'): ?>

<span class="badge bg-success">

Active

</span>

<?php else: ?>

<span class="badge bg-danger">

Inactive

</span>

<?php endif; ?>

</td>

<td>

<a
href="edit.php?id=<?= $user['id'] ?>"
class="btn btn-sm btn-warning">

<i class="fa-solid fa-pen"></i>

</a>

<a
href="delete.php?id=<?= $user['id'] ?>"
class="btn btn-sm btn-danger"
onclick="return confirm('Delete this user?')">

<i class="fa-solid fa-trash"></i>

</a>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>
<?php require '../includes/footer.php'; ?>

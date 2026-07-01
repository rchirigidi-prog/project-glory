<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\UserController;

$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store();
}

$data = $controller->create();
$roles = $data['roles'];

$error = $_SESSION['error'] ?? '';
unset($_SESSION['error']);

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-wrapper">

<?php require_once __DIR__ . '/../includes/navbar.php'; ?>

<div class="dashboard">

<div class="container-fluid">

<h2 class="mb-4">Add User</h2>

<div class="card shadow">

<div class="card-body">

<?php if ($error): ?>

<div class="alert alert-danger">
    <?= htmlspecialchars($error) ?>
</div>

<?php endif; ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">Full Name</label>

<input
type="text"
name="name"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">Role</label>

<select
name="role_id"
class="form-select"
required>

<?php foreach ($roles as $role): ?>

<option value="<?= $role['id'] ?>">
<?= htmlspecialchars($role['name']) ?>
</option>

<?php endforeach; ?>

</select>

</div>

<div class="mb-3">

<label class="form-label">Status</label>

<select
name="status"
class="form-select">

<option value="Active">Active</option>

<option value="Inactive">Inactive</option>

</select>

</div>

<button
class="btn btn-success">

<i class="fas fa-save"></i>

Save User

</button>

<a
href="index.php"
class="btn btn-secondary">

Cancel

</a>

</form>

</div>

</div>

</div>

</div>

</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

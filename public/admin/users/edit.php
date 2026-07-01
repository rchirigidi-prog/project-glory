<?php

require_once __DIR__ . '/../../../bootstrap/app.php';

use App\Controllers\UserController;
use App\Middleware\AuthMiddleware;

AuthMiddleware::handle();

$controller = new UserController();

$id = (int)($_GET['id'] ?? 0);

if ($id <= 0) {
    die("Invalid User ID");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->update($id);
}

$data  = $controller->edit($id);

$user  = $data['user'];
$roles = $data['roles'];

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/sidebar.php';
?>

<div class="main-wrapper">

<?php require_once __DIR__ . '/../includes/navbar.php'; ?>

<div class="dashboard">

<div class="container-fluid">

<h2 class="mb-4">Edit User</h2>

<div class="card shadow">

<div class="card-body">

<form method="POST">

<div class="mb-3">
<label class="form-label">Full Name</label>

<input
type="text"
name="name"
class="form-control"
value="<?= e($user['name']) ?>"
required>

</div>

<div class="mb-3">
<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?= e($user['email']) ?>"
required>

</div>

<div class="mb-3">
<label>Role</label>

<select
name="role_id"
class="form-select">

<?php foreach ($roles as $role): ?>

<option
value="<?= $role['id'] ?>"
<?= $role['id'] == $user['role_id'] ? 'selected' : '' ?>>

<?= e($role['name']) ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="mb-3">
<label>Status</label>

<select
name="status"
class="form-select">

<option
value="Active"
<?= $user['status']=='Active'?'selected':'' ?>>

Active

</option>

<option
value="Inactive"
<?= $user['status']=='Inactive'?'selected':'' ?>>

Inactive

</option>

</select>

</div>

<button class="btn btn-success">
💾 Save Changes
</button>

<a href="index.php"
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

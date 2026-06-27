<?php

session_start();

$error = "";

if(isset($_POST['login'])) {

    $username = "admin";
    $password = "ChangeThisToYourPassword";

    if(
        $_POST['username'] === $username &&
        $_POST['password'] === $password
    ) {

        $_SESSION['prayer_admin'] = true;

        header("Location: prayers.php");

        exit;

    }

    $error = "Invalid Username or Password";

}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Admin Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
background:#0b2345;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.card{
width:400px;
padding:30px;
border-radius:20px;
}

</style>

</head>

<body>

<div class="card">

<h3 class="mb-4">
🔐 Prayer Dashboard Login
</h3>

<?php if($error): ?>

<div class="alert alert-danger">

<?php echo $error; ?>

</div>

<?php endif; ?>

<form method="post">

<input
type="text"
name="username"
class="form-control mb-3"
placeholder="Username"
required>

<input
type="password"
name="password"
class="form-control mb-3"
placeholder="Password"
required>

<button
name="login"
class="btn btn-warning w-100">

Login

</button>

</form>

</div>

</body>

</html>

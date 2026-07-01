<?php

session_start();

if(isset($_SESSION['cms_loggedin'])){

    header("Location: dashboard.php");

    exit;

}

header("Location: login.php");

exit;

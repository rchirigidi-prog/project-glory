<?php

try {

    $pdo = new PDO(
        "mysql:host=localhost;dbname=singthyglory_cms;charset=utf8mb4",
        "root",
        "dm9Lm2t9gdPAQ3aKYtCz"
    );

    echo "<h2>✅ Database Connected Successfully!</h2>";

} catch (Throwable $e) {

    echo "<pre>";
    echo get_class($e) . PHP_EOL;
    echo $e->getMessage() . PHP_EOL;
    print_r($e->errorInfo ?? []);
    echo "</pre>";

}
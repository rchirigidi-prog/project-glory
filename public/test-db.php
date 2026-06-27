<?php

try {

    $pdo = new PDO(
        "mysql:host=project-glory-db;dbname=singthyglory_cms;charset=utf8mb4",
        "stguser",
        "stgpassword"
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2 style='color:green'>✅ Database Connected Successfully!</h2>";

    echo "<p>Server Version: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "</p>";

} catch (PDOException $e) {

    echo "<h2 style='color:red'>❌ Connection Failed</h2>";
    echo "<pre>" . $e->getMessage() . "</pre>";

}
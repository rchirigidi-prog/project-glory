<?php

echo "<h2>Running File</h2>";
echo __FILE__;

echo "<hr>";

echo "<h2>PHP Version</h2>";
echo phpversion();

echo "<hr>";

echo "<h2>SAPI</h2>";
echo php_sapi_name();

echo "<hr>";

echo "<h2>Available PDO Drivers</h2>";
print_r(PDO::getAvailableDrivers());

echo "<hr>";

echo "<h2>Loaded Extensions</h2>";
echo extension_loaded('pdo_mysql')
    ? 'pdo_mysql LOADED'
    : 'pdo_mysql NOT LOADED';
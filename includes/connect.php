<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    // Local connection
    $dsn = "mysql:host=localhost;dbname=Menezes_Henrique_Portfolio;charset=utf8mb4";
    $username = 'root'; // your local username if different
    $password = 'root'; // your local password
} else {
    // Live server connection (adjust these values accordingly)
    $dsn = "mysql:host=localhost;dbname=mmlf6971_portfolio;charset=utf8mb4";
    $username = 'mmlf6971_henriquegamborgi';
    $password = 'lY3u9u*Sig]N';
}

try {
    // Create a new PDO instance
    $connect = new PDO($dsn, $username, $password);
    // Set the PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    error_log($e->getMessage());
    exit('Unable to connect');
}
?>

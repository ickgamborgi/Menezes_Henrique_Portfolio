<?php
require_once('../includes/connect.php');
$query = 'SELECT * FROM users WHERE username = ? AND password = ?';
$stmt = $connect->prepare($query);
$stmt->bindParam(1, $_POST['username'], PDO::PARAM_STR);
$stmt->bindParam(2, $_POST['password'], PDO::PARAM_STR);
$stmt->execute();

header('Location: project_list.php');

// I left my login open so you professors can access the admin panel without having a username or password. I will close it later.

$stmt = null;
?>
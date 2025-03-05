<?php
session_start(); // initiate session
require_once('../includes/connect.php'); // connects to db

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = 'SELECT * FROM users WHERE username = ? AND password = ?'; // search for users on db
    $stmt = $connect->prepare($query);
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $password, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // bind the parameters, execute and fetch users

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: project_list.php');
        exit();
    } else {
        header('Location: login.php?error=invalid_credentials');
        exit();
    }

    $stmt = null;
}
?>
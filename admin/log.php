<?php
session_start();
require_once('../includes/connect.php'); // connects to db

header('Content-Type: application/json'); // make sure the response is in JSON

$response = ['success' => false, 'errors' => ['Invalid request']];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $response['errors'] = ['You need to fill both fields to login'];
        echo json_encode($response);
        exit();
    }

    $query = 'SELECT * FROM users WHERE username = ?'; // search for users in db
    $stmt = $connect->prepare($query);
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // bind the parameters, execute and fetch

    // Use simple equality check if passwords are not hashed
    if ($user && $password === $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $response = ['success' => true, 'redirect' => 'cms_admin.php']; // if the user connects, show success
    } else {
        $response['errors'] = ['Invalid credentials. Are you authorized to access this page?']; // if the user does not connect, show this error
    }

    echo json_encode($response); // encode the response in json so AJAX can show in login.js
    exit();
}
?>

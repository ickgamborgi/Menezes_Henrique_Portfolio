<?php
session_start();
require_once('../includes/connect.php'); // Conecta ao banco de dados

header('Content-Type: application/json'); // Garante que a resposta seja em JSON

$response = ['success' => false, 'errors' => []];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $honeypot = trim($_POST['honeypot'] ?? ''); // Campo honeypot

    // Verifica se o honeypot foi preenchido
    if (!empty($honeypot)) {
        $response['errors'][] = 'Bot detected! Submission blocked.';
        echo json_encode($response);
        exit();
    }

    // Validations
    if (empty($username)) {
        $response['errors'][] = 'Por favor insira seu NOME DE USUÁRIO';
    }

    if (empty($password)) {
        $response['errors'][] = 'Por favor insira a SENHA';
    }

    // Se houver erros, retorna-os
    if (!empty($response['errors'])) {
        echo json_encode($response);
        exit();
    }

    // Busca o usuário no banco de dados
    $query = 'SELECT * FROM users WHERE username = ?';
    $stmt = $connect->prepare($query);
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica as credenciais (use hashing de senha em produção)
    if ($user) {
        if ($password === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $response = ['success' => true, 'redirect' => 'cms_admin.php']; // Login bem-sucedido
        } else {
            $response['errors'][] = 'Acesso inválido! Tem certeza que você pode acessar esta página?';
        }
    } else {
        $response['errors'][] = 'Acesso inválido! Tem certeza que você pode acessar esta página?';
    }

    echo json_encode($response); // Retorna a resposta em JSON
    exit();
}
?>

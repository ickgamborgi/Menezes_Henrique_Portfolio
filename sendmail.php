<?php

require_once('includes/connect.php');

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? ''); // Captura o telefone
$honeypot = trim($_POST['honeypot'] ?? '');
$mathAnswer = trim($_POST['math_answer'] ?? '');
$mathExpected = trim($_POST['math_expected'] ?? '');
$message = trim($_POST['message'] ?? ''); // Mensagem opcional

$errors = [];

// Validações no backend
if (empty($name)) {
    $errors[] = "Please enter FULL NAME for contact";
}

if (empty($email)) {
    $errors[] = "Please fill the EMAIL field";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a VALID EMAIL address";
}

if (!empty($honeypot)) {
    $errors[] = "Bot detected! Submission blocked.";
}

if ($mathAnswer !== $mathExpected) {
    $errors[] = "Please solve SECURITY question correctly";
}

if (empty($phone)) {
    $errors[] = "Please provide your PHONE number";
} else if (!preg_match('/^\+?[0-9\s\-]{7,15}$/', $phone)) {
    $errors[] = "Please enter a VALID PHONE number";
}

// Retorna erros, se houver
if (!empty($errors)) {
    echo json_encode(["errors" => $errors]);
    exit;
}

try {
    // Insere os dados no banco de dados
    $query = "INSERT INTO contact (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $phone, PDO::PARAM_STR); // Adiciona o telefone ao banco de dados
    $stmt->bindParam(4, $message, PDO::PARAM_STR);
    $stmt->execute();

    // Informações do email
    $to = 'henrique@henriquegamborgi.com';
    $subject = 'New contact in your portfolio!';
    $headers = "From: no-reply@henriquegamborgi.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    $emailMessage = "A new message has arrived in your portfolio:\n\n";
    $emailMessage .= "Name: " . $name . "\n";
    $emailMessage .= "Email: " . $email . "\n";
    $emailMessage .= "Phone: " . $phone . "\n"; // Adiciona o telefone ao e-mail
    $emailMessage .= "Message: " . ($message ?: "No message provided.") . "\n";

    mail($to, $subject, $emailMessage, $headers); // Envia o email

    // Retorna mensagem de sucesso
    echo json_encode(["message" => "Message submitted! I'll get back to you super fast — that's a promise!"]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}

?>
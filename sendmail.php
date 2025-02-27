<?php

require_once('includes/connect.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$msg = trim($_POST['message'] ?? '');

$errors = [];

if (empty($name)) {
    $errors[] = "Please, provide your FULL NAME for contact";
}

if (empty($email)) {
    $errors[] = "Please, provide your E-MAIL so I can reach out";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please, provide a REAL e-mail address";
}

if (!empty($errors)) {
    echo json_encode(["errors" => $errors]);
    http_response_code(400);
    exit;
}

try {
    $query = "INSERT INTO contact (name, email, phone, message) VALUES (?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $phone, PDO::PARAM_STR);
    $stmt->bindParam(4, $msg, PDO::PARAM_STR);
    $stmt->execute();

    $to = 'h_gamborgimenezes@fanshaweonline.ca';
    $subject = 'New contact in your portfolio!';
    $headers = "From: no-reply@yourdomain.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    $message = "There is someone interested in your work! A new message has arrived in your portfolio:\n\n";
    $message .= "Name: " . $name . "\n";
    $message .= "Phone: " . $phone . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Message: " . $msg . "\n";

    mail($to, $subject, $message, $headers);

    echo json_encode(["message" => "Message submitted! I'll get back to you super fast — that's a promise!"]);
    http_response_code(200);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    http_response_code(500);
}

?>

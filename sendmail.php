<?php

require_once('includes/connect.php');

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$msg = $_POST['message'] ?? '';

$errors = [];

$name = trim($name);
$email = trim($email);
$phone = trim($phone);
$msg = trim($msg);

if (empty($name)) {
    $errors['name'] = 'Your name cannot be empty';
}

if (empty($email)) {
    $errors['email'] = 'Please provide an e-mail so I can reach you';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['legit_email'] = 'Please insert a REAL e-mail address';
}

if (empty($errors)) {
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

        if (mail($to, $subject, $message, $headers)) {
            header('Location: thankyou.php');
            exit;
        } else {
            echo "Message could not be sent.";
        }

        $stmt = null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    foreach ($errors as $error) {
        echo $error . '<br>';
    }
}

?>

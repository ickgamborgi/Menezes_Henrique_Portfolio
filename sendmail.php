<?php

require_once('includes/connect.php'); // connects to db

header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");

// removes whitespace from beginning and end of string
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$msg = trim($_POST['message'] ?? '');

$errors = []; // make a container array to store errors

if (empty($name)) {
    $errors[] = "Please, provide your FULL NAME for contact";
} // if the user does not fill name, show this

if (empty($email)) {
    $errors[] = "Please, provide your E-MAIL so I can reach out";
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please, provide a REAL e-mail address";
} // if the user does not fill email, show this or if the email is not valid, show the second

if (!empty($errors)) {
    echo json_encode(["errors" => $errors]);
    exit; // if there are errors, stop the script
}

try {
    $query = "INSERT INTO contact (name, email, phone, message) VALUES (?, ?, ?, ?)"; // insert the values into the database
    $stmt = $connect->prepare($query);
    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $phone, PDO::PARAM_STR);
    $stmt->bindParam(4, $msg, PDO::PARAM_STR); // bind parameters 
    $stmt->execute(); // execute query

    // email information
    $from = 'automatic@henriquegamborgi.com';
    $to = 'henrique@henriquegamborgi.com, henriquegamborgi@gmail.com';
    $subject = 'New contact in your portfolio!';
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $message = "A new message has arrived in your portfolio:\n\n";
    $message .= "Name: " . $name . "\n";
    $message .= "Phone: " . $phone . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Message: " . $msg . "\n";

    mail($to, $subject, $message, $headers); // mail it

    echo json_encode(["message" => "Message submitted! I'll get back to you super fast — that's a promise!"]); // if it is successful, show this message
} catch (PDOException $e) {
    echo json_encode(["error" => "There was an error sending the message. Please try again later."]);
} // if there is an error, catch it and show this message

?>

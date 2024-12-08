<?php

require_once('includes/connect.php');

///gather the form content
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$msg = $_POST['message'] ?? '';

$errors = [];

//validate and clean these values

$name = trim($name);
$email = trim($email);
$phone = trim($phone);
$msg = trim($msg);

if(empty($name)) {
    $errors['name'] = 'Your name cannot be empty';
}

if(empty($email)) {
    $errors['email'] = 'Please provide an e-mail so I can reach you';
} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['legit_email'] = 'Please insert a REAL e-mail address';
}

if(empty($errors)) {
    // Insert these values as a new row in the contacts table
    $query = "INSERT INTO contact (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$msg')";

    if(mysqli_query($connect, $query)) {
        // Format and send these values in an email
        $to = 'h_gamborgimenezes@fanshaweonline.ca';
        $subject = 'New contact in your portfolio!';

        $message = "There is someone interested in your work! A new message has arrived in your portfolio:\n\n";
        $message .= "Name: " . $name . "\n";
        $message .= "Phone: " . $phone . "\n";
        $message .= "Email: " . $email . "\n";
        $message .= "Message: " . $msg . "\n";

        if (mail($to, $subject, $message, $headers)) {
            header('Location: thankyou.php');
        } else {
            for($i=0; $i < count($errors); $i++) {
                echo $errors[$i].'<br>';
            }
        }
    }
}
?>

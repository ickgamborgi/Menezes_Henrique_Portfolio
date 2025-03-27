<?php
session_start();
require_once('../includes/connect.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Valida o ID do depoimento
$testimonialId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$testimonialId) {
    die('Invalid testimonial ID.');
}

try {
    // Verifica se o depoimento existe
    $checkQuery = "SELECT * FROM testimonials WHERE id = :id";
    $checkStmt = $connect->prepare($checkQuery);
    $checkStmt->bindParam(':id', $testimonialId, PDO::PARAM_INT);
    $checkStmt->execute();
    $testimonial = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if (!$testimonial) {
        die('Testimonial not found.');
    }

    // Deleta o depoimento
    $deleteQuery = "DELETE FROM testimonials WHERE id = :id";
    $deleteStmt = $connect->prepare($deleteQuery);
    $deleteStmt->bindParam(':id', $testimonialId, PDO::PARAM_INT);

    if ($deleteStmt->execute()) {
        header('Location: testimonial_list.php?message=success');
        exit();
    } else {
        echo "Error deleting testimonial.";
    }
} catch (PDOException $e) {
    echo "Database error: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
}
?>
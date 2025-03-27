<?php
require_once('../includes/connect.php');

// Função para gerar um nome de arquivo único
function generateUniqueFileName($extension) {
    return uniqid('testimonial_', true) . '.' . $extension;
}

// Verifica se o método é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Valida o ID do testimonial
    $testimonialId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if (!$testimonialId) {
        die('Invalid testimonial ID.');
    }

    // Busca os dados do testimonial
    $query = "SELECT * FROM testimonials WHERE id = :id";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':id', $testimonialId, PDO::PARAM_INT);
    $stmt->execute();
    $testimonial = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o testimonial existe
    if (!$testimonial) {
        die('Testimonial not found.');
    }

    // Sanitiza os dados de entrada
    $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
    $position = htmlspecialchars(trim($_POST['position']), ENT_QUOTES, 'UTF-8');
    $quote = htmlspecialchars(trim($_POST['quote']), ENT_QUOTES, 'UTF-8');
    $date = htmlspecialchars(trim($_POST['date']), ENT_QUOTES, 'UTF-8');

    // Valida campos obrigatórios
    if (empty($name) || empty($position) || empty($quote) || empty($date)) {
        die("All fields are required.");
    }

    // Lida com o upload de arquivo
    $picture = $testimonial['picture']; // Mantém a imagem existente por padrão
    if (!empty($_FILES['picture']['name'])) {
        if ($_FILES['picture']['error'] !== UPLOAD_ERR_OK) {
            die("Error uploading the file.");
        }

        $pictureFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
        $mimeType = mime_content_type($_FILES['picture']['tmp_name']);
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($mimeType, $allowedMimeTypes)) {
            die("Invalid file type. Only JPG, JPEG, PNG, GIF, and WEBP are allowed.");
        }

        $pictureNewName = generateUniqueFileName($pictureFileType);
        $picture_path = '../images/' . $pictureNewName;
        if (move_uploaded_file($_FILES['picture']['tmp_name'], $picture_path)) {
            if ($testimonial['picture'] && $testimonial['picture'] !== 'default.jpg') {
                $oldPicturePath = '../images/' . $testimonial['picture'];
                if (file_exists($oldPicturePath)) {
                    unlink($oldPicturePath);
                }
            }
            $picture = $pictureNewName; // Atualiza o nome da imagem
        } else {
            die("Error moving the uploaded file.");
        }
    }

    // Atualiza os dados do testimonial
    try {
        $updateQuery = "UPDATE testimonials SET name = :name, position = :position, picture = :picture, quote = :quote, date = :date WHERE id = :id";
        $updateStmt = $connect->prepare($updateQuery);
        $updateStmt->bindParam(':name', $name, PDO::PARAM_STR);
        $updateStmt->bindParam(':position', $position, PDO::PARAM_STR);
        $updateStmt->bindParam(':picture', $picture, PDO::PARAM_STR);
        $updateStmt->bindParam(':quote', $quote, PDO::PARAM_STR);
        $updateStmt->bindParam(':date', $date, PDO::PARAM_STR);
        $updateStmt->bindParam(':id', $testimonialId, PDO::PARAM_INT);

        $updateStmt->execute();
        header('Location: testimonial_list.php');
        exit;
    } catch (PDOException $e) {
        echo "Error updating testimonial: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    }
} else {
    die('Invalid request method.');
}
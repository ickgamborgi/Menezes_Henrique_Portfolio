<?php
require_once('../includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validação e sanitização dos dados do formulário
    $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
    $position = htmlspecialchars(trim($_POST['position']), ENT_QUOTES, 'UTF-8');
    $quote = htmlspecialchars(trim($_POST['quote']), ENT_QUOTES, 'UTF-8');
    $date = htmlspecialchars(trim($_POST['date']), ENT_QUOTES, 'UTF-8');

    // Inicializa a variável para o nome do arquivo da imagem
    $picture = 'default.jpg'; // Valor padrão caso nenhuma imagem seja enviada

    // Verifica se um arquivo foi enviado
    if (!empty($_FILES['picture']['name'])) {
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp']; // Tipos de arquivo permitidos
        $maxFileSize = 2 * 1024 * 1024; // Tamanho máximo do arquivo (2 MB)

        $pictureFileType = strtolower(pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION));
        $pictureTmp = $_FILES['picture']['tmp_name'];
        $pictureSize = $_FILES['picture']['size'];

        // Valida o tipo de arquivo
        if (!in_array($pictureFileType, $allowedTypes)) {
            die("Invalid file type. Only JPG, JPEG, PNG, GIF, and WEBP are allowed.");
        }

        // Valida o tamanho do arquivo
        if ($pictureSize > $maxFileSize) {
            die("File size exceeds the 2MB limit.");
        }

        // Gera um nome único para o arquivo
        $picture = uniqid('testimonial_', true) . '.' . $pictureFileType;
        $picturePath = '../images/' . $picture;

        // Move o arquivo para o diretório de destino
        if (!move_uploaded_file($pictureTmp, $picturePath)) {
            die("Error uploading the file.");
        }
    }

    // Insere os dados no banco de dados
    $query = "INSERT INTO testimonials (name, position, picture, quote, date) VALUES (:name, :position, :picture, :quote, :date)";
    $stmt = $connect->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':picture', $picture);
    $stmt->bindParam(':quote', $quote);
    $stmt->bindParam(':date', $date);

    if ($stmt->execute()) {
        header('Location: testimonial_list.php');
        exit;
    } else {
        echo "Error adding testimonial.";
    }
}
?>
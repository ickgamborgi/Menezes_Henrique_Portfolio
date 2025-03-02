<?php
require_once('../includes/connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projectId = $_POST['project_id'];

    $mediaQuery = 'SELECT * FROM media WHERE project_id = :projectId';
    $mediaStmt = $connect->prepare($mediaQuery);
    $mediaStmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
    $mediaStmt->execute();
    $mediaFiles = $mediaStmt->fetchAll(PDO::FETCH_ASSOC);

    $deleteQuery = 'DELETE FROM media WHERE project_id = :projectId';
    $deleteStmt = $connect->prepare($deleteQuery);
    $deleteStmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
    $deleteStmt->execute();

    $checkMediaQuery = 'SELECT COUNT(*) FROM media WHERE project_id = :projectId';
    $checkMediaStmt = $connect->prepare($checkMediaQuery);
    $checkMediaStmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
    $checkMediaStmt->execute();
    $mediaCount = $checkMediaStmt->fetchColumn();

    if ($mediaCount == 0) {
        $defaultImage = 'demoreel_poster.jpg';
        $insertDefaultMediaQuery = 'INSERT INTO media (project_id, url) VALUES (:projectId, :defaultImage)';
        $insertDefaultMediaStmt = $connect->prepare($insertDefaultMediaQuery);
        $insertDefaultMediaStmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
        $insertDefaultMediaStmt->bindParam(':defaultImage', $defaultImage, PDO::PARAM_STR);
        $insertDefaultMediaStmt->execute();
    }

    header('Location: edit_project_form.php?id=' . $projectId);
    exit();
}
?>
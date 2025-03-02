<?php
    require_once('../includes/connect.php');
    $query = 'DELETE FROM project WHERE project.id = :projectId';
    $stmt = $connect->prepare($query);
    $projectId = $_GET['id'];
    $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
    $stmt->execute();
    $stmt = null;
    header('Location: project_list.php');
?>
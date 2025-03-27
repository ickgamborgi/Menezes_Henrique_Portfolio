<?php
    require_once('../includes/connect.php');
    
    $query = 'DELETE FROM project WHERE project.id = :projectId'; // delete project from database where the project id matches the selected project
    $stmt = $connect->prepare($query);
    $projectId = $_GET['id']; // get the id
    $stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT); // bind parameters
    $stmt->execute(); // execute
    $stmt = null;
    header('Location: project_list.php'); // redirect 
?>
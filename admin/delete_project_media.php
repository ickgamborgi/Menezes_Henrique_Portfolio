<!-- // I made this extra php file to delete function the "delete all media" on individual projects. -->

<?php
require_once('../includes/connect.php'); // connect to db

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $projectId = $_POST['project_id']; // get project id from form

    $mediaQuery = 'SELECT * FROM media WHERE project_id = :projectId'; // select all media files from project
    $mediaStmt = $connect->prepare($mediaQuery);
    $mediaStmt->bindParam(':projectId', $projectId, PDO::PARAM_INT); // bind project id
    $mediaStmt->execute();
    $mediaFiles = $mediaStmt->fetchAll(PDO::FETCH_ASSOC); // fetch all media files

    $deleteQuery = 'DELETE FROM media WHERE project_id = :projectId'; // delete all media files from project   
    $deleteStmt = $connect->prepare($deleteQuery);
    $deleteStmt->bindParam(':projectId', $projectId, PDO::PARAM_INT); // bind project id
    $deleteStmt->execute(); // execute delete query

    $checkMediaQuery = 'SELECT COUNT(*) FROM media WHERE project_id = :projectId'; // check if media files were deleted
    $checkMediaStmt = $connect->prepare($checkMediaQuery);
    $checkMediaStmt->bindParam(':projectId', $projectId, PDO::PARAM_INT); // bind project id
    $checkMediaStmt->execute();
    $mediaCount = $checkMediaStmt->fetchColumn(); // fetch media count

    // I added this because if the user deleted all media files, the project media would be empty and a php error would appear. So I added a default image to it if there are no media files attached to this project.
    if ($mediaCount == 0) {
        $defaultImage = 'demoreel_poster.jpg'; // direct default image
        $insertDefaultMediaQuery = 'INSERT INTO media (project_id, url) VALUES (:projectId, :defaultImage)'; // insert default image to media table
        $insertDefaultMediaStmt = $connect->prepare($insertDefaultMediaQuery);
        $insertDefaultMediaStmt->bindParam(':projectId', $projectId, PDO::PARAM_INT); // bind project id
        $insertDefaultMediaStmt->bindParam(':defaultImage', $defaultImage, PDO::PARAM_STR); // bind default image
        $insertDefaultMediaStmt->execute();
    }

    header('Location: edit_project_form.php?id=' . $projectId); // reload edit project page
    exit();
}
?>
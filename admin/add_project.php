<?php
require_once('../includes/connect.php'); // connect to database

function generateUniqueFileName($extension) {
    $random = rand(10000, 99999);
    $newname = 'image' . $random . '.' . $extension;
    return $newname; // generate unique file name for uploaded files
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // for project cover image
    $coverFileType = strtolower(pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION));
    if ($coverFileType == 'jpeg') {
        $coverFileType = 'jpg'; // convert jpeg to jpg
    }
    if ($coverFileType == 'exe') {
        exit('nice try'); // prevent uploading exe files
    }
    $coverNewName = generateUniqueFileName($coverFileType); // attach unique file name
    $coverTargetFile = '../images/' . $coverNewName; // save file to images folder

    // for project thumbnail image
    $thumbFileType = strtolower(pathinfo($_FILES['thumb']['name'], PATHINFO_EXTENSION));
    if ($thumbFileType == 'jpeg') {
        $thumbFileType = 'jpg'; // convert jpeg to jpg
    }
    if ($thumbFileType == 'exe') {
        exit('nice try'); // prevent uploading exe files
    }
    $thumbNewName = generateUniqueFileName($thumbFileType); // attach unique file name
    $thumbTargetFile = '../images/' . $thumbNewName; // save file to images folder

    // if files are uploaded successfully, upload into database
    if (move_uploaded_file($_FILES['cover']['tmp_name'], $coverTargetFile) && move_uploaded_file($_FILES['thumb']['tmp_name'], $thumbTargetFile)) { 
        $query = "INSERT INTO project (title, subtitle, cover, thumb, prototype_link, type, date, duration, role, areas, recap, briefing, process, takeaways, tools) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; // query to insert project details into database
        $stmt = $connect->prepare($query);
        $stmt->bindParam(1, $_POST['title'], PDO::PARAM_STR);
        $stmt->bindParam(2, $_POST['subtitle'], PDO::PARAM_STR);
        $stmt->bindParam(4, $thumbNewName, PDO::PARAM_STR);
        $stmt->bindParam(3, $coverNewName, PDO::PARAM_STR);
        $stmt->bindParam(5, $_POST['prototype_link'], PDO::PARAM_STR);
        $stmt->bindParam(6, $_POST['type'], PDO::PARAM_STR);
        $stmt->bindParam(7, $_POST['date'], PDO::PARAM_STR);
        $stmt->bindParam(8, $_POST['duration'], PDO::PARAM_STR);
        $stmt->bindParam(9, $_POST['role'], PDO::PARAM_STR);
        $stmt->bindParam(10, $_POST['areas'], PDO::PARAM_STR);
        $stmt->bindParam(11, $_POST['recap'], PDO::PARAM_STR);
        $stmt->bindParam(12, $_POST['briefing'], PDO::PARAM_STR);
        $stmt->bindParam(13, $_POST['process'], PDO::PARAM_STR);
        $stmt->bindParam(14, $_POST['takeaways'], PDO::PARAM_STR);
        $stmt->bindParam(15, $_POST['tools'], PDO::PARAM_STR);
        $stmt->execute(); // bind parameters and execute query

        $projectId = $connect->lastInsertId(); // get last inserted project id

        // for multiple media files
        foreach ($_FILES['media']['name'] as $key => $name) {
            if (!empty($name)) {
                $mediaFileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));
                if ($mediaFileType == 'jpeg') {
                    $mediaFileType = 'jpg'; // convert jpeg to jpg
                }
                if ($mediaFileType == 'exe') {
                    exit('nice try'); // prevent uploading exe files
                }
        
                $mediaNewName = generateUniqueFileName($mediaFileType);
                $mediaTargetFile = '../images/' . $mediaNewName; // save files to images folder
        
                // if files are uploaded successfully, upload into database
                if (move_uploaded_file($_FILES['media']['tmp_name'][$key], $mediaTargetFile)) {
                    $mediaQuery = "INSERT INTO media (project_id, url) VALUES (?, ?)"; // query to insert media files into database
                    $mediaStmt = $connect->prepare($mediaQuery); 
                    $mediaStmt->bindParam(1, $projectId, PDO::PARAM_INT);
                    $mediaStmt->bindParam(2, $mediaNewName, PDO::PARAM_STR);
                    $mediaStmt->execute(); // bind parameters and execute query
                } else {
                    echo 'Failed to upload media file: ' . $name;
                } // in case there is an error, display error message
            }
        }
        

        header('Location: project_list.php'); // redirect to main admin page
    } else {
        echo 'Failed to upload files.'; // in case there is an error, display error message
    }
}
?>
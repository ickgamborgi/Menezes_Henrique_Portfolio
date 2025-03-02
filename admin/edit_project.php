<?php
require_once('../includes/connect.php');

function generateUniqueFileName($extension) {
    $random = rand(10000, 99999);
    $newname = 'image' . $random . '.' . $extension;
    return $newname;
}

$coverNewName = null;
if (!empty($_FILES['cover']['name'])) {
    $coverFileType = strtolower(pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION));
    if ($coverFileType == 'jpeg') {
        $coverFileType = 'jpg';
    }
    if ($coverFileType == 'exe') {
        exit('nice try');
    }
    $coverNewName = generateUniqueFileName($coverFileType);
    $coverTargetFile = '../images/' . $coverNewName;
    move_uploaded_file($_FILES['cover']['tmp_name'], $coverTargetFile);
}

$thumbNewName = null;
if (!empty($_FILES['thumb']['name'])) {
    $thumbFileType = strtolower(pathinfo($_FILES['thumb']['name'], PATHINFO_EXTENSION));
    if ($thumbFileType == 'jpeg') {
        $thumbFileType = 'jpg';
    }
    if ($thumbFileType == 'exe') {
        exit('nice try');
    }
    $thumbNewName = generateUniqueFileName($thumbFileType);
    $thumbTargetFile = '../images/' . $thumbNewName;
    move_uploaded_file($_FILES['thumb']['tmp_name'], $thumbTargetFile);
}

$query = "SELECT cover, thumb FROM project WHERE id = ?";
$stmt = $connect->prepare($query);
$stmt->bindParam(1, $_POST['pk'], PDO::PARAM_INT);
$stmt->execute();
$currentProject = $stmt->fetch(PDO::FETCH_ASSOC);

if ($coverNewName === null) {
    $coverNewName = $currentProject['cover'];
}
if ($thumbNewName === null) {
    $thumbNewName = $currentProject['thumb'];
}

$query = "UPDATE project SET title = ?, subtitle = ?, cover = ?, thumb = ?, prototype_link = ?, type = ?, date = ?, duration = ?, role = ?, areas = ?, recap = ?, briefing = ?, process = ?, takeaways = ?, tools = ? WHERE id = ?";

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
$stmt->bindParam(16, $_POST['pk'], PDO::PARAM_INT);

$stmt->execute();

if (isset($_FILES['media'])) {

    $defaultImage = 'demoreel_poster.jpg';
    $deleteDefaultQuery = 'DELETE FROM media WHERE project_id = ? AND url = ?';
    $deleteDefaultStmt = $connect->prepare($deleteDefaultQuery);
    $deleteDefaultStmt->bindParam(1, $_POST['pk'], PDO::PARAM_INT);
    $deleteDefaultStmt->bindParam(2, $defaultImage, PDO::PARAM_STR);
    $deleteDefaultStmt->execute();

    foreach ($_FILES['media']['name'] as $key => $name) {
        if (!empty($name)) {
            $mediaFileType = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            if ($mediaFileType == 'jpeg') {
                $mediaFileType = 'jpg';
            }
            if ($mediaFileType == 'exe') {
                exit('nice try');
            }
            $mediaNewName = generateUniqueFileName($mediaFileType);
            $mediaTargetFile = '../images/' . $mediaNewName;

            if (move_uploaded_file($_FILES['media']['tmp_name'][$key], $mediaTargetFile)) {
                $mediaQuery = "INSERT INTO media (project_id, url) VALUES (?, ?)";
                $mediaStmt = $connect->prepare($mediaQuery);
                $mediaStmt->bindParam(1, $_POST['pk'], PDO::PARAM_INT);
                $mediaStmt->bindParam(2, $mediaNewName, PDO::PARAM_STR);
                $mediaStmt->execute();
            } else {
                echo 'Failed to move uploaded file: ' . $_FILES['media']['tmp_name'][$key];
            }
        }
    }
}

$stmt = null;
header('Location: project_list.php');
exit();
?>
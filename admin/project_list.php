<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<?php

require_once('../includes/connect.php'); // connects to db

$userQuery = 'SELECT username FROM users WHERE id = :userId';
$userStmt = $connect->prepare($userQuery);
$userStmt->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
$userStmt->execute();
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

$stmt = $connect->prepare('SELECT * FROM project ORDER BY date DESC'); // select all projects and order them by last updated
$stmt->execute();

// I have built this to make the ENUM possible to be used in the form as project type
$enumQuery = $connect->prepare("SHOW COLUMNS FROM project LIKE 'type'");
$enumQuery->execute();
$enumRow = $enumQuery->fetch(PDO::FETCH_ASSOC);

$enumValuesArray = [];
if ($enumRow) {
    $enumValues = str_replace("'", "", substr($enumRow['Type'], 5, -1));
    $enumValuesArray = explode(',', $enumValues);
}

// Language Switcher
$current_uri = $_SERVER['REQUEST_URI'];
$parsed_url = parse_url($current_uri);
$path = $parsed_url['path'];
$query = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : '';

// Check if we're in the /br/ directory
$is_br = strpos($path, '/br/') !== false || preg_match('#/br$#', $path);

// Normalize the base path (works with subfolders like /Menezes_Henrique_Portfolio/)
$script_name = $_SERVER['SCRIPT_NAME'];
$script_dir = dirname($script_name); // e.g., /Menezes_Henrique_Portfolio or /Menezes_Henrique_Portfolio/br

// Logic to handle the URLs dynamically
if ($is_br) {
    // If we're in /br, remove "/br" from the path for the English version
    $en_url = str_replace('/br', '', $path); // Remove '/br' for English version
    $pt_url = $current_uri; // Stay on the Portuguese page
} else {
    // If we're in the root, we need to add "/br" to the path for the Portuguese version
    $base_path = rtrim($script_dir, '/'); // Normalize the base path
    $pt_url = $base_path . '/br' . str_replace($base_path, '', $path) . $query; // Add '/br' to the path for Portuguese version
    $en_url = $current_uri; // Stay on the English page
}
?>

<!-- Document Heading -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../css/grid.css" rel="stylesheet"> <!-- Link to CSS grid -->
    <link href="../css/main.css" rel="stylesheet"> <!-- Link to Main CSS file -->

    <!-- Ubuntu Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- plyr.io library-->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />

    <!-- Font awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Script tags with defer attribute -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script> <!-- link to greensock main library and scroll plugin -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/ScrollTrigger.js"></script>
    <script defer src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script type="module" src="../js/main.js"></script>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../images/icon-white.svg">

    <!-- Document Title -->
    <title>Portfolio Projects List</title> 
</head>

<body>
    <h1 class="hidden">Portfolio Projects List</h1>

    <!-- Header -->
    <div id="sticky-nav-con">
        <h2 class="hidden">Header</h2>
        <header>
            <!-- Main Navigation -->
            <nav class="navbar-header grid-con">
                <h3 class="hidden">Main Navigation</h3>
    
                <div class="logo-header col-start-1">
                    <a href="../index.php"><img src="../images/horizontal-color.svg" alt="Henrique Gamborgi Logo"></a>
                </div>
    
                <button id="burger-button"></button>
    
                <div class="links-header">
                    <h4 class="hidden">Links Header</h4>
                    <ul>
                        <li><a href="../index.php" class="nav-item"><h5>Portfolio</h5></a></li>
                        <li><a href="../contact.php" class="nav-item"><h5>Contact</h5></a></li>
                        <li><a href="cms_admin.php" class="nav-item"><h5>Admin <i class="fas fa-gear icon-gear"></i></h5></a></li>
                        <li><a href="logout.php" class="nav-item"><h5>Logout <i class="fas fa-sign-out icon-logout"></i></h5></a></li>
                    </ul>
                    <!-- Language Switcher -->
                    <div class="lang-switcher">
                        <?php if ($is_br): ?>
                            <img src="../images/brazil-flag.svg" alt="Português" class="flag active" />
                            <a href="<?= $en_url ?>">
                                <img src="../images/uk-flag.svg" alt="English" class="flag inactive" />
                            </a>
                        <?php else: ?>
                            <a href="<?= $pt_url ?>">
                                <img src="../images/brazil-flag.svg" alt="Português" class="flag inactive" />
                            </a>
                            <img src="../images/uk-flag.svg" alt="English" class="flag active" />
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </header>
    </div>

    <main>
        <h2 class="hidden">Main Content</h2>

        <section class="grid-con project-list-section">

        <a href="cms_admin.php" class="col-span-full cms-back-button"><h3>< Back to Admin Main Page</h3></a>

        <div class="col-span-full admin-welcome">
                <h3><i class="fas fa-solid fa-object-group"></i>Manage Projects</h3>
                <p>Here you can <span>CREATE, READ, UPDATE</span> and <span>DELETE</span> projects from the website.</p>
        </div>

            <div class="project-list-crud col-span-full">
               <h3 class="col-span-full"><i class="fas fa-list icon-list"></i>All Projects</h3>
                    <?php

                    // List of Projects
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        echo '<div class="project-list-crud-item">
                            <div class="crud-item-title">
                                <h4><span>'.$row['title'].'</span></h4>
                            </div>
                            <div class="crud-item-action">
                                <a class="edit-button" href="edit_project_form.php?id='.$row['id'].'">edit</a>
                                <a class="delete-button" href="delete_project.php?id='.$row['id'].'" onclick="return confirm(\'Are you sure you want to delete this project?\');">delete</a>
                            </div>
                            </div>';
                    }

                    $stmt = null;

                    ?>
            </div>
        </section>

        <section class="grid-con project-add-crud">
            <div class="project-add-crud-con col-span-full">
            <h3><i class="fas fa-plus icon-add"></i>Add New Project</h3>
                <form action="add_project.php" method="post" enctype="multipart/form-data" class="form">
                    
                    <label class="form-label" for="title">Title: </label>
                    <input name="title" type="text" placeholder="EX: Fanshawe College" required>

                    <label class="form-label" for="subtitle">Subtitle: </label>
                    <input name="subtitle" type="text" placeholder="EX: Website" required>

                    <label class="form-label" for="thumb">Thumbnail: </label>
                    <p class="form-comment">Upload images with 1:1 aspect ratio (square). Accepted formats: JPEG, JPG, PNG, GIF or WEBP.</p>
                    <input name="thumb" type="file" required>

                    <label class="form-label" for="cover">Cover: </label>
                    <p class="form-comment">Upload images with 3:1 aspect ratio (banner). Accepted formats: JPEG, JPG, PNG, GIF or WEBP.</p>
                    <input name="cover" type="file" required>

                    <label class="form-label" for="prototype_link">Prototype Link: </label>
                    <input name="prototype_link" type="text" placeholder="https://github.com" required>

                    <label class="form-label" for="type">Project Type: </label>
                    <select name="type" required>
                    <?php
                        if (!empty($enumValuesArray)) {
                            foreach ($enumValuesArray as $value) {
                                echo '<option value="'.$value.'">'.$value.'</option>';
                            }
                        } else {
                            echo '<option value="">No project types available</option>';
                        }
                    ?>
                    </select>

                    <label class="form-label" for="date">Project Date: </label>
                    <input name="date" type="text" placeholder="IN: YYYY/MM" required>

                    <label class="form-label" for="duration">Project Duration: </label>
                    <input name="duration" type="text" placeholder="EX: 2 months — Aug, 2020 to Jan, 2021" required>

                    <label class="form-label" for="role">Role: </label>
                    <input name="role" type="text" placeholder="EX: Full stack and Sole designer" required>

                    <label class="form-label" for="areas">Project Areas: </label>
                    <input name="areas" type="text" placeholder="EX: Branding, Web and Design" required>

                    <label class="form-label" for="recap">Project Recap: </label>
                    <textarea name="recap" placeholder="EX: Lorem Ipsum..." required></textarea>

                    <label class="form-label" for="briefing">Briefing: </label>
                    <textarea name="briefing" placeholder="EX: Lorem Ipsum..." required></textarea>

                    <label class="form-label" for="process">Process: </label>
                    <textarea name="process" placeholder="EX: Lorem Ipsum..." required></textarea>

                    <label class="form-label" for="takeaways">Takeaways: </label>
                    <textarea name="takeaways" placeholder="EX: Lorem Ipsum..." required></textarea>

                    <label class="form-label" for="tools">Tools used: </label>
                    <textarea name="tools"placeholder="EX: Lorem Ipsum..."  required></textarea>
                    
                    <label class="form-label" for="media">Add Media: </label>
                    <p class="form-comment">Upload one or more image files. Accepted formats: JPEG, JPG, PNG, GIF or WEBP.</p>
                    <input name="media[]" type="file" required multiple>

                    <input id="submit-button" name="submit" type="submit" value="Add Project">
                </form>
        </section>
        <section class="grid-con" id="project-list-logout">
            <div class="logout-button col-span-full">
             <a href="logout.php"><h5>Logout <i class="fas fa-sign-out icon-logout"></i></h5></a>
            </div>
        </section>

    </main>
</body>
</html>

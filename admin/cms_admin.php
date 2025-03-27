<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once('../includes/connect.php');

// Busca o nome de usuário do banco de dados
$userQuery = 'SELECT username FROM users WHERE id = :userId';
$userStmt = $connect->prepare($userQuery);
$userStmt->bindParam(':userId', $_SESSION['user_id'], PDO::PARAM_INT);
$userStmt->execute();
$user = $userStmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o usuário foi encontrado
if (!$user) {
    echo "Error: User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

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
    <title>Edit Project Page</title> 
</head>

<body>
    <h1 class="hidden">Admin Dashboard</h1>

    <div id="sticky-nav-con">
        <h2 class="hidden">Header</h2>
        <header>
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
                        <li><a href="cms_admin.php" class="nav-item current"><h5>Admin <i class="fas fa-gear icon-gear"></i></h5></a></li>
                        <li><a href="logout.php" class="nav-item"><h5>Logout <i class="fas fa-sign-out icon-logout"></i></h5></a></li>
                    </ul>
                </div>
            </nav>
        </header>
    </div>

    <main>
        <h2 class="hidden">Main Content</h2>

        <section class="grid-con edit-project-section">
            <div class="col-span-full admin-welcome">
                <h3><i class="fas fa-gear icon-gear"></i> Hello, <?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></h3>
                <p>Welcome to My Portfolio Content Management System. Here you can <span>CREATE, READ, UPDATE</span> and <span>DELETE</span> content from my website. Use the links below to navigate through the CMS.</p>
            </div>

            <div class="col-span-full project-list-crud">
                <div class="admin-link-item">
                    <a href="project_list.php">
                        <h4><i class="fas fa-list fa-object-group"></i>Manage Projects</h4>
                        <p>Create, edit, and delete portfolio projects.</p>
                    </a>
                </div>
                <div class="admin-link-item">
                    <a href="testimonial_list.php">
                        <h4> <i class="fas fa-comments fa-users"></i> Manage Testimonials</h4>
                        <p>Add, edit, and remove testimonials.</p>
                    </a>
                </div>
                <div class="admin-link-item">
                    <a href="edit_links.php">
                        <h4> <i class="fas fa-comments fa-link"></i> Manage Links</h4>
                        <p>Edit URLs for social media and resume</p>
                    </a>
                </div>
            </div>
        </section>
        <section class="grid-con" id="project-list-logout">
            <div class="logout-button col-span-full">
             <a href="logout.php"><h5>Logout <i class="fas fa-sign-out icon-logout"></i></h5></a>
            </div>
        </section>
    </main>
</body>

</html>
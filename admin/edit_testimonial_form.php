<?php
session_start();
session_regenerate_id(true);
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once('../includes/connect.php');

// Valida o ID do testimonial
$testimonialId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
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
    <title>Edit Testimonial Page</title> 
</head>

<body>
    <h1 class="hidden">Edit Testimonial</h1>

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

        <section class="grid-con edit-project-section">
            <a href="testimonial_list.php" class="col-span-full cms-back-button"><h3>< Back to All Testimonials</h3></a>
            <div class="edit-project-con col-span-full">
                <h4 class="col-span-full"><i class="fas fa-edit icon-edit"></i>Edit Testimonial</h4>
                <form action="edit_testimonial.php" method="POST" enctype="multipart/form-data">
                    <input name="id" type="hidden" value="<?php echo htmlspecialchars($testimonial['id'], ENT_QUOTES, 'UTF-8'); ?>">

                    <label class="form-label" for="name">Name: </label>
                    <input name="name" type="text" value="<?php echo htmlspecialchars($testimonial['name'], ENT_QUOTES, 'UTF-8'); ?>" required>

                    <label class="form-label" for="position">Position: </label>
                    <input name="position" type="text" value="<?php echo htmlspecialchars($testimonial['position'], ENT_QUOTES, 'UTF-8'); ?>" required>

                    <label class="form-label" for="picture">Picture: </label>
                    <p class="form-comment">Upload images with 1:1 aspect ratio (square). Accepted formats: JPEG, JPG, PNG, GIF or WEBP.</p>
                    <img class="current-thumb" src="../images/<?php echo htmlspecialchars($testimonial['picture'], ENT_QUOTES, 'UTF-8'); ?>" alt="Current Testimonial Picture">
                    <input id="choose-file" name="picture" type="file">

                    <label class="form-label" for="date">Date: </label>
                    <input name="date" type="text" value="<?php echo htmlspecialchars($testimonial['date'], ENT_QUOTES, 'UTF-8'); ?>" required>

                    <label class="form-label" for="quote">Quote: </label>
                    <textarea name="quote" required><?php echo htmlspecialchars($testimonial['quote'], ENT_QUOTES, 'UTF-8'); ?></textarea>

                    <input id="submit-button" name="submit" type="submit" value="Save Changes">
                </form>
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
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
$query = 'SELECT * FROM project WHERE project.id = :projectId'; // select details from projects where the project id matches the selected project
$stmt = $connect->prepare($query);
$projectId = $_GET['id']; // get the selected id
$stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT); // bind parameters
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC); // fetch all details

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
    <title>Editar Projeto</title> 
</head>

<body>
    <h1 class="hidden">Editar Projeto</h1>

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
                        <li><a href="../index.php" class="nav-item"><h5>Portfólio</h5></a></li>
                        <li><a href="../contact.php" class="nav-item"><h5>Contato</h5></a></li>
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
        <section class="grid-con edit-project-section">
            <a href="project_list.php" class="col-span-full cms-back-button"><h3>< Voltar para Projetos</h3></a>
            <div class="edit-project-con col-span-full">
                <h4 class="col-span-full"><i class="fas fa-edit icon-edit"></i>Editar Projeto</h4>
                <form action="edit_project.php" method="POST" enctype="multipart/form-data">
                    <input name="pk" type="hidden" value="<?php echo $row['id']; ?>">

                    <label class="form-label" for="title">Título do Projeto: </label>
                    <input name="title" type="text" value="<?php echo $row['title']; ?>" required>

                    <label class="form-label" for="subtitle">Subtítulo do Projeto: </label>
                    <input name="subtitle" type="text" value="<?php echo $row['subtitle']; ?>" required>

                    <label class="form-label" for="thumb">Thumbnail do Projeto: </label>
                    <p class="form-comment">Upload images with 1:1 aspect ratio (square). Accepted formats: JPEG, JPG, PNG, GIF or WEBP.</p>
                        <img class="current-thumb" src="../images/<?php echo $row['thumb']; ?>" alt="Current Project Thumb">
                    <input id="choose-file" name="thumb" type="file">


                    <label class="form-label" for="cover">Capa do Projeto: </label>
                    <p class="form-comment">Upload images with 3:1 aspect ratio (banner). Accepted formats: JPEG, JPG, PNG, GIF or WEBP.</p>
                        <img class="current-cover" src="../images/<?php echo $row['cover']; ?>" alt="Current Project Cover">
                    <input id="choose-file-2" name="cover" type="file">

                    <label class="form-label" for="prototype_link">Link para Protótipo do Projeto: </label>
                    <input name="prototype_link" type="text" value="<?php echo $row['prototype_link']; ?>" required>

                    <label class="form-label" for="type">Tipo de Projeto: </label>
                    <select name="type" required>
                    <?php
                        if (!empty($enumValuesArray)) {
                            foreach ($enumValuesArray as $value) {
                                $selected = ($value == $row['type']) ? 'selected' : '';
                                echo '<option value="'.$value.'" '.$selected.'>'.$value.'</option>';
                            }
                        } else {
                            echo '<option value="">No project types available</option>';
                        }
                    ?>
                    </select>

                    <label class="form-label" for="date">Data do Projeto: </label>
                    <input name="date" type="text" value="<?php echo $row['date']; ?>" required>

                    <label class="form-label" for="duration">Duração do Projeto: </label>
                    <input name="duration" type="text" value="<?php echo $row['duration']; ?>" required>

                    <label class="form-label" for="role">Função no Projeto: </label>
                    <input name="role" type="text" value="<?php echo $row['role']; ?>" required>

                    <label class="form-label" for="areas">Áreas do Projeto: </label>
                    <input name="areas" type="text" value="<?php echo $row['areas']; ?>" required>

                    <label class="form-label" for="recap">Intro do Projeto: </label>
                    <textarea name="recap" required><?php echo $row['recap']; ?></textarea>

                    <label class="form-label" for="briefing">Fase de Imersão do Projeto: </label>
                    <textarea name="briefing" required><?php echo $row['briefing']; ?></textarea>

                    <label class="form-label" for="process">Fase de Execução do Projeto: </label>
                    <textarea name="process" required><?php echo $row['process']; ?></textarea>

                    <label class="form-label" for="takeaways">Fase de Resultados do Projeto: </label>
                    <textarea name="takeaways" required><?php echo $row['takeaways']; ?></textarea>

                    <label class="form-label" for="tools">Ferramentas do Projeto: </label>
                    <textarea name="tools" required><?php echo $row['tools']; ?></textarea>

                    <label class="form-label" for="media">Mídia do Projeto: </label>
                    <p class="form-comment">Upload one or more image files. Accepted formats: JPEG, JPG, PNG, GIF or WEBP.</p>
                    <input id="choose-file-3" name="media[]" type="file" multiple>

                    <input id="submit-button" name="submit" type="submit" value="Salvar Alterações">
                </form>
            </div>
                <form class="delete-media-form col-span-full" action="delete_project_media.php" method="POST" onsubmit="return confirm('Are you sure you want to delete all media for this project? If you proceed, the media table will be loaded in the page as a default image.');">
                    <input type="hidden" name="project_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" value="Deletar Mídia" id="delete-media">
                </form>
                <div class="logout-button col-span-full">
                    <a href="logout.php"><h5>Logout <i class="fas fa-sign-out icon-logout"></i></h5></a>
                </div>

            <?php $stmt = null;?>
        </section>
    </main>
    </body>
</html>
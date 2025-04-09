<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once('../includes/connect.php');

// Atualiza o link se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $linkId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $url = trim($_POST['url']);

    if ($linkId && !empty($url)) {
        $updateQuery = "UPDATE link SET url = :url WHERE id = :id";
        $updateStmt = $connect->prepare($updateQuery);
        $updateStmt->bindParam(':url', $url, PDO::PARAM_STR);
        $updateStmt->bindParam(':id', $linkId, PDO::PARAM_INT);

        if ($updateStmt->execute()) {
            $message = "Link updated successfully!";
        } else {
            $message = "Error updating the link.";
        }
    } else {
        $message = "Invalid data. Please try again.";
    }
}

// Busca todos os links da tabela
$stmtLinks = $connect->prepare('SELECT id, name, url FROM link ORDER BY name ASC');
$stmtLinks->execute();
$links = $stmtLinks->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Lista de Links</title> 
</head>

<body>
    <h1 class="hidden">Editar Links</h1>

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
        <h2 class="hidden">Main Content</h2>

        <section class="grid-con project-list-section">

            <a href="cms_admin.php" class="col-span-full cms-back-button"><h3>< Voltar ao Painel Principal</h3></a>

            <div class="col-span-full admin-welcome">
                <h3><i class="fas fa-solid fa-link"></i>Gerenciar Links</h3>
                <p>Aqui você pode <span>LER</span> e <span>ATUALIZAR</span> links importantes do website.</p>
            </div>

            <div class="project-list-crud col-span-full">
                <h3 class="col-span-full"><i class="fas fa-list icon-list"></i> Todos os Links</h3>
                <div class="message-feedback">
                    <?php if (!empty($message)): ?>
                        <h4 id="feedback"><?php echo $message; ?></h4>
                    <?php endif; ?>
                </div>
                <div class="crud-table">
                    <?php foreach ($links as $link): ?>
                        <form action="" method="POST" class="crud-table-row">
                            <input type="hidden" name="id" value="<?php echo $link['id']; ?>">
                                <label class="form-label"><?php echo $link['name'];?></label>
                                <div>
                                    <input type="text" name="url" value="<?php echo $link['url']; ?>" required>
                                    <button type="submit" class="edit-button">Salvar</button>
                                </div>
                        </form>
                    <?php endforeach; ?>
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
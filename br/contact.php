<!DOCTYPE html>
<html lang="en">
<?php
require_once('includes/connect.php');

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

// Fetch testimonials ordered by date (new code)
$stmtTestimonials = $connect->prepare('SELECT name, position, picture, quote FROM testimonials ORDER BY date DESC');
$stmtTestimonials->execute();
$testimonials = $stmtTestimonials->fetchAll(PDO::FETCH_ASSOC);

// Consulta para buscar os links necessários
$stmtLinks = $connect->prepare('SELECT name, url FROM link WHERE name IN ("Resume", "Github", "Instagram", "Behance", "Linkedin", "Whatsapp")');
$stmtLinks->execute();
$links = $stmtLinks->fetchAll(PDO::FETCH_ASSOC);

// Cria um array associativo para facilitar o acesso aos links
$linkUrls = [];
foreach ($links as $link) {
    $linkUrls[$link['name']] = $link['url'];
}
?>

<!-- Document Heading -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta Descriptions -->
    <meta name="description" content="Bem-vindo à página de Contato! Deixe suas informações e vamos tirar suas ideias do papel!">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Henrique Gamborgi: Contato">
    <meta property="og:description" content="Bem-vindo à página de Contato! Deixe suas informações e vamos tirar suas ideias do papel!">
    <meta property="og:image" content="https://henriquegamborgi.com/images/demoreel_poster.webp"> <!-- Substitua pelo caminho da sua imagem -->
    <meta property="og:url" content="https://henriquegamborgi.com">
    <meta property="og:type" content="website">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Henrique Gamborgi: Contato">
    <meta name="twitter:description" content="Bem-vindo à página de Contato! Deixe suas informações e vamos tirar suas ideias do papel!">
    <meta name="twitter:image" content="https://henriquegamborgi.com/images/demoreel_poster.webp"> <!-- Substitua pelo caminho da sua imagem -->

    <link href="css/grid.css" rel="stylesheet"> <!-- Link to CSS grid -->
    <link href="css/main.css" rel="stylesheet"> <!-- Link to Main CSS file -->

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
    <script type="module" src="js/main.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="./images/icon-white.svg">

    <!-- Document Title -->
    <title>Henrique Gamborgi: Contato</title> 
</head>

<!-- Documemnt Body -->
<body>
    <h1 class="hidden">Henrique Gamborgi: Contato</h1>

    <!-- Header -->
    <div id="sticky-nav-con">
        <h2 class="hidden">Header</h2>
        <header>
            <!-- Main Navigation -->
            <nav class="navbar-header grid-con">
                <h3 class="hidden">Main Navigation</h3>

                <div class="logo-header col-start-1">
                    <a href="index.php"><img src="./images/horizontal-color.svg" alt="Henrique Gamborgi Logo"></a>
                </div>

                <button id="burger-button"></button>

                <div class="links-header">
                    <h4 class="hidden">Links Header</h4>
                    <ul>
                        <li><a href="index.php" class="nav-item"><h5>Início</h5></a></li>
                        <li><a href="about.php" class="nav-item"><h5>Sobre</h5></a></li>
                        <li><a href="contact.php" class="nav-item current"><h5>Contato</h5></a></li>
                        <li><a href="<?php echo $linkUrls['Resume'] ?? '#'; ?>" target="_blank" class="nav-item"><h5>Currículo</h5></a></li>
                    </ul>

                    <!-- Language Switcher -->
                    <div class="lang-switcher">
                        <?php if ($is_br): ?>
                            <img src="./images/brazil-flag.svg" alt="Português" class="flag active" />
                            <a href="<?= $en_url ?>">
                                <img src="./images/uk-flag.svg" alt="English" class="flag inactive" />
                            </a>
                        <?php else: ?>
                            <a href="<?= $pt_url ?>">
                                <img src="./images/brazil-flag.svg" alt="Português" class="flag inactive" />
                            </a>
                            <img src="./images/uk-flag.svg" alt="English" class="flag active" />
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </header>
    </div>

    <!-- Main Content -->
    <main>
        <h2 class="hidden">Main Content</h2>

        <section class="full-width-grid-con banner" id="contact-banner">
            <div class="full-width-grid-con banner-cover"></div>
            
            <div class="col-span-full banner-title">
                <h3 class="col-span-4"><span>Entre em Contato</span></h3>
                <div class="col-span-4 banner-divisory" id="contact-divisory"></div>
                <a href="<?php echo $linkUrls['Whatsapp'] ?? '#'; ?>" target="_blank" class="banner-btn col-span-3">
                    <h4 class="small-button">Abrir no WhatsApp</h4>
                </a>
            </div>
        </section>

        <section class="grid-con" id="contact-form">
            <h3 class="hidden">Formulário de Contato</h3>
            <h4 class="col-span-4 m-col-span-7">Preencha o formulário abaixo</h4>
            <p class="contact-text col-span-4 m-col-span-7">Vamos colaborar! Deixe suas ideias aqui e entrarei em contato o mais rápido possível. Você pode me enviar uma mensagem para discutir projetos, opotunidades ou simplesmente conversar! </p>
            <p class="contact-text col-span-4 m-col-span-7"><span>Aguardo sua mensagem!</span></p>

            <div class="form-section col-span-4 m-col-span-8">
                <h4 class="hidden">Contact Form</h4>
                <form class="form" method="post" action="sendmail.php">
                    <input name="name" type="text" placeholder="Nome Completo">
                    <input name="email" type="email" placeholder="E-mail">
                    <input name="phone" type="tel" placeholder="Celular">
                    <textarea name="message" placeholder="Deixe aqui suas ideias ou mensagem..."></textarea>

                    <!-- Honeypot Field (Hidden from Users) -->
                    <input type="text" name="honeypot" id="honeypot" style="display: none;">

                    <!-- Math Question -->
                    <input type="number" id="math-answer" name="math_answer" placeholder="">
                    <input type="hidden" id="math-expected" name="math_expected">

                    <div id="feedback" class="col-span-full"><p>Por favor preencha todas os os campos</p></div>
                    <button name="submit" type="submit" value="Send"><span>Enviar</span></button>
                </form>
            </div>

            <div class="project-thank col-span-full">
                <img src="./images/illustration-3.webp" alt="Thank You Humaaan" class="thank-you">
                <div class=back-wrap>
                    <h4>A gente se fala em breve!</h4>
                    <a href="index.php" class="back-btn col-span-3">
                            <h5 class="small-button">Voltar a Página Principal</h5>
                    </a>
                </div>
            </div>

        </section>

        <!-- Services Section -->
        <section class="services grid-con">
            <h3 class="hidden">Services Section</h3>

            <div class="testimonial-title col-span-full">
                <h4>Serviços e Pacotes</h4>
            </div>

            <div class="service-con col-span-4 m-col-span-4 l-col-span-4">
                <img src="./images/package-brand.svg" alt="Service Icon" class="service-icon">
                <div class="service-title">
                    <h5>Pacote de Marca</h5>
                    <p class="service-brief">Mais do que um logotipo: descubra uma nova alma e identidade para o seu projeto</p>
                </div>
                <div class="service-process">
                    <h6>Processo</h6>
                    <p class="service-p">Briefing - Descoberta - Imersão - Ideação - Implementação - Gestão</p>
                </div>
                <div class="service-deliverables">
                    <h6>Entregáveis</h6>
                    <p class="service-p">Versões do Logotipo - Tipografia - Cores - Manual de Marca - Aplicações</p>
                </div>
                <a href="contact.php" class="service-btn">
                    <h5 class="small-button">Estou Interessado!</h5>
                    <i class="fa-solid fa-square-caret-right"></i>
                </a>
            </div>

            <div class="service-con col-span-4 m-col-span-4 l-col-span-4">
                <img src="./images/package-digital.svg" alt="Service Icon" class="service-icon">
                <div class="service-title">
                    <h5>Pacote Digital</h5>
                    <p class="service-brief">Alavanque sua presença online com uma nova experiência para seu website</p>
                </div>
                <div class="service-process">
                    <h6>Processo</h6>
                    <p class="service-p">Briefing - Descoberta - Imersão - Wireframes - Prototipagem - Implementação - Gestão</p>
                </div>
                <div class="service-deliverables">
                    <h6>Entregáveis</h6>
                    <p class="service-p">Wireframes - Protótipo Interativo - Front-End - CMS - SEO</p>
                </div>
                <a href="contact.php" class="service-btn">
                    <h5 class="small-button">Estou Interessado!</h5>
                    <i class="fa-solid fa-square-caret-right"></i>
                </a>
            </div>

            <div class="service-con col-span-4 m-col-span-4 l-col-span-4">
                <img src="./images/package-product.svg" alt="Service Icon" class="service-icon">
                <div class="service-title">
                    <h5>Pacote de Produto</h5>
                    <p class="service-brief">Transforme suas ideias em realidade com um design e conceito único para seu produto</p>
                </div>
                <div class="service-process">
                    <h6>Processo</h6>
                    <p class="service-p">Briefing - Descoberta - Imersão - Ideação - Execução - Prototipagem - Implementação - Suporte</p>
                </div>
                <div class="service-deliverables">
                    <h6>Entregáveis</h6>
                    <p class="service-p">Arte Conceito - Renders - Protótipo - Arquivos para Produção - Suporte de Produção</p>
                </div>
                <a href="contact.php" class="service-btn">
                    <h5 class="small-button">Estou Interessado!</h5>
                    <i class="fa-solid fa-square-caret-right"></i>
                </a>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials grid-con" id="contact-test">
            <h3 class="hidden">Testimonial Section</h3>

            <div class="testimonial-title col-span-full">
                <h4>O que eu ouvi por aí...</h4>
            </div>

            <div class="testimonial col-span-full">

                <?php
                $firstTestimonial = true;
                foreach ($testimonials as $testimonial) {
                    $visibleClass = $firstTestimonial ? 'visible' : ''; // Add 'visible' class to the first testimonial
                    $firstTestimonial = false; // Set flag to false after the first iteration
                    echo "<div class='testimonial-card $visibleClass'>";
                    echo "<h5 class='hidden'>Testimonial Card</h5>";
                    echo "<h6 class='testimonial-quote-mark'>\"</h6>";
                    echo "<p>{$testimonial['quote']}</p>";
                    echo "<div class='testimonial-bio'>";
                    echo "<div class='testimonial-pic'>";
                    echo "<img src='./images/{$testimonial['picture']}' alt='Testimonial Giver'>";
                    echo "</div>";
                    echo "<div class='testimonial-name'>";
                    echo "<h6>{$testimonial['name']}</h6>";
                    echo "<h7>{$testimonial['position']}</h7>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>

                <div class="testimonial-controls col-span-full">
                    <h5 class="hidden">Testimonial Navigation</h5>
                    <button class="testimonial-button" id="test-prev-btn">&#10094;</button>
                    <button class="testimonial-button" id="test-next-btn">&#10095;</button>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="grid-con">
            <h3 class="hidden">Footer</h3>

            <div class="footer-copy col-span-full m-col-start-1 l-col-start-1 l-col-end-6">
                <h4 class="hidden">Copyright Information</h4>
                <a href="index.php"><img src="./images/icon-white.svg" alt="Henrique Gamborgi Symbol"></a>
                <a href="admin/login.php"><h5>2025 Copyright    &copy;</h5></a>
                <h5>Henrique Gamborgi Design</h5>
            </div>

            <div class="footer-social col-span-full m-col-start-1 l-col-start-9">
                <h4 class="hidden">Links</h4>

                <div class="footer-social-media">
                    <a href="<?php echo $linkUrls['Github'] ?? '#'; ?>" target="_blank">
                        <div class="social-media-item">
                            <h5 class="hidden">GitHub</h5>
                            <img src="./images/github.svg" alt="GitHub icon" class="social-media-icon">
                        </div>
                    </a>
    
                    <a href="<?php echo $linkUrls['Behance'] ?? '#'; ?>" target="_blank">
                        <div class="social-media-item">
                            <h5 class="hidden">Behance</h5>
                            <img src="./images/behance.svg" alt="Behance icon" class="social-media-icon">
                        </div>
                    </a>
    
                    <a href="<?php echo $linkUrls['Instagram'] ?? '#'; ?>" target="_blank">
                        <div class="social-media-item">
                            <h5 class="hidden">Instagram</h5>
                            <img src="./images/instagram.svg" alt="Instagram icon" class="social-media-icon">
                        </div>
                    </a>
    
                    <a href="<?php echo $linkUrls['Linkedin'] ?? '#'; ?>" target="_blank">
                        <div class="social-media-item">
                            <h5 class="hidden">LinkedIn</h5>
                            <img src="./images/linkedin.svg" alt="LinkedIn icon" class="social-media-icon">
                        </div>
                    </a>
                </div>
                
                <div class="footer-resume">
                    <a href="<?php echo $linkUrls['Resume'] ?? '#'; ?>" class="resume" target="_blank">
                        <h5 class="small-button">Currículo</h5>
                        <i class="fa-solid fa-square-caret-right arrow"></i>
                    </a>
                </div>

            </div>
        </footer>

    </main>
</body>

</html>
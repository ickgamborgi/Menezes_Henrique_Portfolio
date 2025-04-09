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
    <meta name="description" content="Bem-vindo a minha Página Pessoal! Descubra mais sobre mim, minha jornada e hobbies!">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Henrique Gamborgi: Sobre Mim">
    <meta property="og:description" content="Bem-vindo a minha Página Pessoal! Descubra mais sobre mim, minha jornada e hobbies!">
    <meta property="og:image" content="https://henriquegamborgi.com/images/demoreel_poster.webp"> <!-- Substitua pelo caminho da sua imagem -->
    <meta property="og:url" content="https://henriquegamborgi.com">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Henrique Gamborgi: Sobre Mim">
    <meta name="twitter:description" content="Bem-vindo a minha Página Pessoal! Descubra mais sobre mim, minha jornada e hobbies!">
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
    <title>Henrique Gamborgi: Sobre Mim</title> 
</head>

<!-- Documemnt Body -->
<body>
    <h1 class="hidden">Henrique Gamborgi: Sobre Mim</h1>

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
                        <li><a href="about.php" class="nav-item current"><h5>Sobre</h5></a></li>
                        <li><a href="contact.php" class="nav-item"><h5>Contato</h5></a></li>
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

        <section class="full-width-grid-con banner" id="about-banner">
            <div class="full-width-grid-con banner-cover"></div>
            
            <div class="banner-about-wrap col-span-full">
                <img src="./images/about-profile.jpg" alt="Henrique's About Me Picture">

                <div class="col-span-full banner-title">
                    <h3 class="col-span-6"><span>Sobre Mim</span></h3>
                    <div class="col-span-6 banner-divisory" id="about-divisory"></div>
                    <a href="<?php echo $linkUrls['Resume'] ?? '#'; ?>" target="_blank" class="banner-btn col-span-3">
                        <h4 class="small-button">Visite meu Currículo</h4>
                    </a>
                </div>
            </div>
        </section>


        <!-- About Section -->
        <section class="bio grid-con">
            <h3 class="hidden">About Section</h3>

            
            <div class="col-span-full subtitle-wrap">
                <h4>Moro em</h4>
                <div>
                    <img src="./images/canada-flag.svg" alt="Canada Flag">
                    <h5>London, ON, Canada</h5>
                </div>
            </div>

            <div class="col-span-full subtitle-wrap">
                <h4>Nasci em</h4>
                <div>
                    <img src="./images/brazil-flag.svg" alt="Canada Flag">
                    <h5>Florianópolis, SC, Brasil</h5>
                </div>
            </div>

            <div class="col-span-full l-col-end-7 bio-text">
                <h4>Muito prazer, sou Henrique!</h4>
                <p>
                    <span>Sou um designer brasileiro que não só ama estudar, como também nunca esqueceu aquela criança que acreditava que seus desenhos iriam mudar o mundo.</span> Meus sonhos criativos sempre me impulsionaram a querer tirar ideias do papel — e eu simplesmente adoro entender por que e como as pessoas interagem com produtos, tecnologias e mídias. Enquanto meu lado curioso reflete sobre tudo isso, meu lado designer quer criar. E, antes mesmo de descobrir que isso tinha um nome, eu já era totalmente apaixonado por design. Hoje, tenho mais de 6 anos de experiência. Iniciei meus estudos na Universidade Federal de Santa Catarina (UFSC), onde me formei em Design, com foco principal em construção e gestão de marcas.
                </p>
            </div>

            <div class="col-span-full l-col-start-8 bio-text">
                <p>
                Após isso, me aventurei em projetos como freelancer, o que também me trouxe grande conhecimento em marketing, estratégias de venda e como lidar com o mundo real somado ao design funcional. Em 2023, minha jornada me levou ao Canadá, onde atualmente estudo Design para Mídias Interativas, na Fanshawe College. Ao longo dos anos, tive o prazer de participar de vários projetos e acabei me tornando um tipo de profissional raro: um designer apaixonado por branding, UX, marketing, programação, edição de vídeo, motion e gestão de projetos. É sério, eu amo design!
                </p>
            </div>

            <div class="col-span-full l-col-end-7 bio-images">
                <div class="bio-image" id="bio-image-1">
                    <div class="bio-cover"></div>
                    <p>Primeiro Inverno no Canadá</p>
                </div>
                <div class="bio-image" id="bio-image-2">
                    <div class="bio-cover"></div>
                    <p>Minha Graduação na UFSC</p>
                </div>
                <div class="bio-image" id="bio-image-3">
                    <div class="bio-cover"></div>
                    <p>Dia do Meu Casamento</p>
                </div>
            </div>

            <div class="col-span-full l-col-start-8 bio-hobbies">
                <h4>No meu tempo livre, eu amo</h4>
                <div class="hobbies-list">
                    <h5><span>&#x1F3AC;</span> Filmes &amp; Séries</h5>
                    <h5><span>&#x1F3A7;</span> Muita Música</h5>
                    <h5><span>&#x1F94A;</span> Artes Marciais</h5>
                    <h5><span>&#x1F60E;</span> Design &amp; Programação</h5>
                    <h5><span>&#x1F33A;</span> Jardinagem</h5>
                    <h5><span>&#x1F30D;</span> Viajar</h5>
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

        <!-- Tools Section -->
        <section class="home-tools grid-con">
            <h3 class="col-span-full">Ferramentas Favoritas</h3>

            <img class="mug-image col-span-4 l-col-span-3" src="./images/mug-best-boss.svg" alt="World's Best Designer Coffee Mug">

            <div class="tools-list col-span-4">
                <h4 class="hidden">Tools List</h4>

                <div class="tools-item">
                    <div class="tools-btn">
                        <h5 class="small-button">Softwares</h5>
                        <i class="fa-solid fa-square-caret-right arrow"></i>
                    </div>

                    <div class="tools-open hidden">
                        <div class="tool">
                            <img src="./images/icon-ai.svg" alt="Software icon" class="skill-icon">
                            <h6>Adobe Illustrator</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/icon-figma.svg" alt="Software icon" class="skill-icon">
                            <h6>Adobe XD &amp; Figma</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/icon-ps.svg" alt="Software icon" class="skill-icon">
                            <h6>Adobe Photoshop</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/icon-ae.svg" alt="Software icon" class="skill-icon">
                            <h6>Adobe AfterEffects</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/icon-c4d.svg" alt="Software icon" class="skill-icon">
                            <h6>Cinema 4D &amp; Blender</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/icon-vscode.svg" alt="Software icon" class="skill-icon">
                            <h6>Visual Studio Code</h6>
                        </div>
                    </div>
                </div>


                <div class="tools-item">
                    <div class="tools-btn">
                        <h5 class="small-button">Programação</h5>
                        <i class="fa-solid fa-square-caret-right arrow"></i>
                    </div>

                    <div class="tools-open hidden">
                        <div class="tool">
                            <img src="./images/icon-html.svg" alt="Coding icon" class="skill-icon">
                            <h6>HTML5</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/icon-css.svg" alt="Coding icon" class="skill-icon">
                            <h6>CSS3 &amp; SASS</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/icon-js.svg" alt="Coding icon" class="skill-icon">
                            <h6>Javascript &amp; AJAX</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/icon-php.svg" alt="Coding icon" class="skill-icon">
                            <h6>PHP &amp; WordPress</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/icon-git.svg" alt="Coding icon" class="skill-icon">
                            <h6>GitHub Workflow</h6>
                        </div>
                    </div>
                </div>

                <div class="tools-item">
                    <div class="tools-btn">
                        <h5 class="small-button">Idiomas</h5>
                        <i class="fa-solid fa-square-caret-right arrow"></i>
                    </div>
                    <div class="tools-open">
                        <div class="tool">
                            <img src="./images/brazil-flag.svg" alt="Brazilian flag" class="skill-icon">
                            <h6>Português (nativo)</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/uk-flag.svg" alt="UK flag" class="skill-icon">
                            <h6>Inglês (fluente)</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/spain-flag.svg" alt="Spanish flag" class="skill-icon">
                            <h6>Espanhol (intermediário)</h6>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials grid-con">
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

       <!-- Contact Section -->
       <section class="contact-section grid-con">
            <h3 class="col-span-full">Vamos tirar suas ideias do papel!</h3>
    
            <div class="redux-form-section col-span-full">
                <h4 class="hidden">Contact Form</h4>
                <form class="form" method="post" action="sendmail.php">
                    <input name="name" type="text" placeholder="Nome Completo">
                    <input name="email" type="email" placeholder="E-mail">
                    <input name="message" type="text"  placeholder="Assunto">

                    <!-- Honeypot Field (Hidden from Users) -->
                    <input type="text" name="honeypot" id="honeypot">

                    <!-- Math Question -->
                    <input type="number" id="math-answer" name="math_answer" placeholder="">
                    <input type="hidden" id="math-expected" name="math_expected">
                    
                    <button name="submit" type="submit" value="Send"><span>Enviar</span></button>
                </form>
                <div id="feedback" class="col-span-full"><p>Por favor preencha todas os os campos</p></div>
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
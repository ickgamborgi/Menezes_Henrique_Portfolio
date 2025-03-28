<!DOCTYPE html>
<html lang="en">

<?php
require_once('includes/connect.php');

// Fetch project details
$query = 'SELECT * FROM project,media WHERE project_id = project.id AND project.id = :projectId';
$stmt = $connect->prepare($query);
$projectId = $_GET['id'];
$stmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch media
$mediaQuery = 'SELECT * FROM media WHERE project_id = :projectId';
$mediaStmt = $connect->prepare($mediaQuery);
$mediaStmt->bindParam(':projectId', $projectId, PDO::PARAM_INT);
$mediaStmt->execute();
$mediaResults = $mediaStmt->fetchAll(PDO::FETCH_ASSOC);

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

$stmt = null;
?>

<!-- Document Heading -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Meta Descriptions -->
    <meta name="description" content="<?php echo $row['recap']?>">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="Case Study: <?php echo $row['title']?> <?php echo $row['subtitle']?>">
    <meta property="og:description" content="<?php echo $row['recap']?>">
    <meta property="og:image" content="https://henriquegamborgi.com/images/<?php echo $row['cover']?>"> <!-- Substitua pelo caminho da sua imagem -->
    <meta property="og:url" content="https://henriquegamborgi.com">
    <meta property="og:type" content="website">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Case Study: <?php echo $row['title']?> <?php echo $row['subtitle']?>">
    <meta name="twitter:description" content="<?php echo $row['recap']?>">
    <meta name="twitter:image" content="https://henriquegamborgi.com/images/<?php echo $row['cover']?>"> <!-- Substitua pelo caminho da sua imagem -->

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
    <link rel="icon" type="image/x-icon" href="images/icon-white.svg">

    <!-- Document Title -->
    <title>Case Study: <?php echo $row['title']?> <?php echo $row['subtitle']?></title> 
</head>

<!-- Documemnt Body -->
<body>
    <h1 class="hidden">Case Study: <?php echo $row['title']?> <?php echo $row['subtitle']?></h1>

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
                        <li><a href="index.php" class="nav-item current"><h5>Home</h5></a></li>
                        <li><a href="about.php" class="nav-item"><h5>About</h5></a></li>
                        <li><a href="contact.php" class="nav-item"><h5>Contact</h5></a></li>
                        <li><a href="<?php echo $linkUrls['Resume'] ?? '#'; ?>" target="_blank" class="nav-item"><h5>Resume</h5></a></li>
                    </ul>
                </div>
            </nav>
        </header>
    </div>

    <!-- Main Content -->
    <main>
        <h2 class="hidden">Main Content</h2>

        <section class="full-width-grid-con banner" id="case-banner">
            <img class="project-cover" src="./images/<?php echo $row['cover']?>" alt="Project Cover">
            <div class="full-width-grid-con banner-cover"></div>
            
            <div class="banner-about-wrap col-span-full">

                <div class="col-span-full banner-title">
                    <h3 class="col-span-6"><span><?php echo $row['title']?></span> <?php echo $row['subtitle']?></h3>                    
                    <div class="col-span-6 banner-divisory" id="about-divisory"></div>
                    <div class="col-span-full case-wrap">
                        <a href="<?php echo $row['prototype_link']?>" target="_blank" class="banner-btn">
                            <h4 class="small-button">Open Creation</h4>
                        </a>
                        <div class="case-type">
                            <i class="fa-solid fa-earth-americas icon"></i>
                            <h4><?php echo $row['type']?> project</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Case Study Intro Section -->
        <section class="bio grid-con bio">
            <h3 class="hidden">Case Study Intro Section</h3>
            
            <div class="col-span-full subtitle-wrap">
                <h4>Date</h4>
                <div>
                    <h5><?php echo $row['duration']?></h5>
                </div>
            </div>

            <div class="col-span-full subtitle-wrap">
                <h4>Role</h4>
                <div>
                    <h5><?php echo $row['role']?></h5>
                </div>
            </div>

            <div class="col-span-full subtitle-wrap">
                <h4>Areas</h4>
                <div>
                    <h5><?php echo $row['areas']?></h5>
                </div>
            </div>

            <div class="col-span-full subtitle-wrap">
                <h4>Recap</h4>
                <div>
                    <p><?php echo $row['recap']?></p>
                </div>
            </div>

            <div class="col-span-full l-col-span-10 case-text-con">
                <!-- Briefing -->
                <div class="col-span-full l-col-end-7 case-text">
                    <div class="case-title-wrap">
                        <i class="fa-solid fa-magnifying-glass icon"></i>
                        <h4>Briefing</h4>
                    </div>
                    <p><?php echo $row['briefing']?></p>
                </div>
                
                <!-- Process -->
                <div class="col-span-full l-col-start-7 case-text">
                    <div class="case-title-wrap">
                        <i class="fa-regular fa-lightbulb icon"></i>
                        <h4>Process</h4>
                    </div>
                    <p><?php echo $row['process']?></p>
                </div>
            </div>

            <!-- Project Media -->
            <div class="col-span-full project-media-con">

                <?php foreach ($mediaResults as $media): ?>
                
                <img src="./images/<?php echo htmlspecialchars($media['url']); ?>" alt="Project Media Asset" class="project-media-image">
                
                <?php endforeach; ?>
            </div>
            
            <div class="col-span-full l-col-span-10 case-text-con">
                <!-- Takeaways -->
                <div class="col-span-full l-col-end-7 case-text">
                    <div class="case-title-wrap">
                        <i class="fa-solid fa-seedling icon"></i>
                        <h4>Takeaways</h4>
                    </div>
                    <p><?php echo $row['takeaways']?></p>
                </div>
                
                <!-- Tools -->
                <div class="col-span-full l-col-start-7 case-text">
                    <div class="case-title-wrap">
                        <i class="fa-solid fa-gears icon"></i>
                        <h4>Tools and Softwares</h4>
                    </div>
                    <p><?php echo $row['tools']?></p>
                </div>
            </div>

            <div class="project-thank col-span-full">
                <img src="./images/illustration-1.webp" alt="Thank You Humaaan" class="thank-you">
                <div class=back-wrap>
                    <h4>Thank you for viewing!</h4>
                    <a href="index.php#portfolio-sec" class="back-btn col-span-3">
                            <h5 class="small-button">Back to Portfolio</h5>
                    </a>
                </div>
            </div>

        </section>

    

                <!-- Testimonials Section -->
                <section class="testimonials grid-con">
            <h3 class="hidden">Testimonial Section</h3>

            <div class="testimonial-title col-span-full">
                <h4>That's what they said!</h4>
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
            <h3 class="col-span-full">Let's bring your ideas to life!</h3>
    
            <div class="redux-form-section col-span-full">
                <h4 class="hidden">Contact Form</h4>
                <form class="form" method="post" action="sendmail.php">
                    <input name="name" type="text" placeholder="Full Name">
                    <input name="email" type="email" placeholder="E-mail Address">
                    <input name="message" type="text"  placeholder="Subject">
                    <button name="submit" type="submit" value="Send"><span>Submit</span></button>
                </form>
                <div id="feedback" class="col-span-full"><p>Please fill out all required sections</p></div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="grid-con">
            <h3 class="hidden">Footer</h3>

            <div class="footer-copy col-span-full m-col-start-1 l-col-start-1 l-col-end-6">
                <h4 class="hidden">Copyright Information</h4>
                <a href="index.php"><img src="./images/icon-white.svg" alt="Henrique Gamborgi Symbol"></a>
                <a href="admin/login.php"><h5>2024 Copyright    &copy;</h5></a>
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
                        <h5 class="small-button">Resume</h5>
                        <i class="fa-solid fa-square-caret-right arrow"></i>
                    </a>
                </div>

            </div>
        </footer>

    </main>
</body>

</html>
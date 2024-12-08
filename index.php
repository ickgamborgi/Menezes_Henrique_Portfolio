<!DOCTYPE html>
<html lang="en">

<?php
//conect to the running database server and the specific database EX: $connect = new mysqli('localhost','root','root','bookstore');
require_once('includes/connect.php');

//create a query to run in SQL
$query = 'SELECT project.id AS id, thumb, title, subtitle, date, areas, recap, title FROM project';

 //run the query to get back the content
$results = mysqli_query($connect,$query);
// print_r($results);

?>

<!-- Document Heading -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="css/grid.css" rel="stylesheet"> <!-- Link to CSS grid -->
    <link href="css/main.css" rel="stylesheet"> <!-- Link to Main CSS file -->

    <!-- Ubuntu Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- plyr.io library-->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />

    <!-- Font awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Script tags with defer attribute -->
    <script defer src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script defer src="js/main.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/icon-white.svg">

    <!-- Document Title -->
    <title>Henrique Gamborgi: Portfolio</title> 
</head>

<!-- Documemnt Body -->
<body>
    <h1 class="hidden">Henrique Gamborgi: Portfolio</h1>

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
                        <li><a href="index.php" class="nav-item"><h5>Portfolio</h5></a></li>
                        <li><a href="about.html" class="nav-item"><h5>About</h5></a></li>
                        <li><a href="contact.html" class="nav-item"><h5>Contact</h5></a></li>
                        <li><a href="https://drive.google.com/file/d/1IVieGaWlVBvap9UwNIM0GwgP0hnsdKhI/view?usp=sharing" target="_blank" class="nav-item"><h5>Resume</h5></a></li>
                    </ul>
                </div>
            </nav>
        </header>
    </div>

    <!-- Main Content -->
    <main>
        <h2 class="hidden">Main Content</h2>

        <!-- Hero Section -->
        <section class="home-hero grid-con">
            <h3 class="hidden">Hero Section</h3>
            
            <div class="hero-image-con col-span-full m-col-span-4 m-col-start-1">
                <h4 class="hidden">Profile Image</h4>
                <img class="hero-image" src="./images/hero-picture.webp" alt="Profile Image">

                <div class="hero-social-media">
                    <h5 class="hidden">Social Media Links</h5>
                    <a href="https://github.com/ickgamborgi/" target="_blank">
                        <div class="social-media-item">
                            <h5 class="hidden">GitHub</h5>
                            <img src="./images/github.svg" alt="GitHub icon" class="social-media-icon">
                        </div>
                    </a>
    
                    <a href="https://behance.com/ickgamborgi" target="_blank">
                        <div class="social-media-item">
                            <h5 class="hidden">Behance</h5>
                            <img src="./images/behance.svg" alt="Behance icon" class="social-media-icon">
                        </div>
                    </a>
    
                    <a href="https://instagram.com/inkgamborgi" target="_blank">
                        <div class="social-media-item">
                            <h5 class="hidden">Instagram</h5>
                            <img src="./images/instagram.svg" alt="Instagram icon" class="social-media-icon">
                        </div>
                    </a>
    
                    <a href="https://linkedin.com/in/ickgamborgi/" target="_blank">
                        <div class="social-media-item">
                            <h5 class="hidden">LinkedIn</h5>
                            <img src="./images/linkedin.svg" alt="LinkedIn icon" class="social-media-icon">
                        </div>
                    </a>
                </div>
            </div>

            <div class="hero-bio col-span-full m-col-start-5">
                <h5><span>I am a Designer</span> @ Canada and Brasil</h5>
                <p>
                    And truthfully, design is my passion. I do all kinds of it: <span>user experience and web, branding, product, video and front-end development.</span>
                </p>
                <div class="hero-availability">
                    <div></div>
                    <h6>Available for Work</h6>
                </div>
            </div>
        </section>

        <!-- Introduction Section -->
        <section class="home-intro grid-con">
            <h3 class="hidden">Introduction Section</h3>

            <!-- Video Player -->
            <div class="video-holder col-span-full m-col-start-1 m-col-end-9 l-col-end-8">
                <h4 class="hidden">Demo Reel</h4>
                <video
                    id="demoreel"
                    class="player" 
                    controls
                    loop
                    preload="metadata"
                    >
                    <source src="videos/demoreel.mp4" type="video/mp4">
                </video>
            </div>

            <div class="intro-text col-span-full m-col-start-1 m-col-end-9 l-col-start-8 l-col-end-13">
                <h4>Welcome to my little corner of the world!</h4>
                <p>
                    I'm a designer passionate about how people connect with brands, products, and media. With 6+ years of experience, I've contributed to various projects, and I might be just who you're looking for in your next design journey. <br>
                    <br>
                    Scroll down to explore my portfolio, I hope you enjoy it!
                </p>
                <a href="about.html" class="intro-btn">
                    <h5 class="small-button">More About Me</h5>
                    <i class="fa-solid fa-square-caret-right arrow"></i>
                </a>
            </div>
        </section>

        <!-- Portfolio Section -->
        <section class="portfolio grid-con" id="portfolio-sec">
            <h3 class="hidden">Portfolio Section</h3>

            <div class="portfolio-title col-span-full">
                <h4>Discover my portfolio!</h4>
                <!-- <div>
                    <h5 class="hidden">Design area filters</h5>
                    <ul class="portfolio-tags">
                        <li><a><h6 class="portfolio-tag selected">All Projects</h6></a></li>
                        <li><a><h6 class="portfolio-tag">Ux | Web</h6></a></li>
                        <li><a><h6 class="portfolio-tag">Branding</h6></a></li>
                        <li><a><h6 class="portfolio-tag">Product</h6></a></li>
                        <li><a><h6 class="portfolio-tag">Editorial</h6></a></li>
                    </ul>
                </div> -->
            </div>

            <!-- Portfolio Gallery -->
            <article class="portfolio-gallery col-span-full">
                <h4 class="hidden">Projects gallery</h4>

                <?php

                while($row = mysqli_fetch_array($results)) {

                echo '
                <!-- Project Item -->
                <div class="portfolio-item">
                    <h5 class="hidden">Portfolio item</h5>

                    <!-- thumbnail -->
                    <a href="casestudy.php?id='.$row['id'].'">
                        <img class="project-thumb" src="./images/'.$row['thumb'].'" alt="Project Thumbnail">
                    </a>

                    <div class="portfolio-item-info">
                        <!-- Title and Subtitle -->
                        <h6 class="project-title"><span>'.$row['title'].'</span> '.$row['subtitle'].'</h6>

                        <!-- Areas -->
                        <p class="project-areas">'.$row['areas'].'</p>

                        <!-- Date -->
                        <p class="project-date">'.$row['date'].'</p>

                        <!-- Recap -->
                        <p class="project-recap">'.$row['recap'].'</p>
                    
                        <a href="casestudy.php?id='.$row['id'].'" class="intro-btn">
                            <h5 class="small-button">Case Study</h5>
                            <i class="fa-solid fa-square-caret-right arrow"></i>
                        </a>
                    </div>
                </div>';

                }?>

            </article>

        </section>

        <!-- Testimonials Section -->
        <section class="testimonials grid-con">
            <h3 class="hidden">Testimonial Section</h3>

            <div class="testimonial-title col-span-full">
                <h4>That's what they said!</h4>
            </div>

            <div class="testimonial col-span-full">

                <div class="testimonial-card visible">
                    <h5 class="hidden">Testimonial Card 1</h5>
                    <h6 class="testimonial-quote-mark">"</h6>
                    <p>
                        Henrique is a distinguished professional. His approach to challenges is always positive and stimulating. We worked together through several projects and different contexts - including university, junior enterprise and market. He is dedicated and engaged, always eager to learn and reach high-quality results.
                    </p>
    
                    <div class="testimonial-bio">
                        <div class="testimonial-pic">
                            <img src="./images/test-1.jpg" alt="Testimonial Giver">
                        </div>
                        <div class="testimonial-name">
                            <h6>Charles Crimson</h6>
                            <h7>Colleague and business partner</h7>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <h5 class="hidden">Testimonial Card 2</h5>
                    <h6 class="testimonial-quote-mark">"</h6>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus, doloribus labore? Consequatur exercitationem magni inventore perspiciatis at. Modi maiores qui atque sunt minima sint quisquam unde voluptatem, eligendi dolorem quibusdam autem porro eius totam rem aut laudantium veritatis eveniet ut temporibus.
                    </p>
    
                    <div class="testimonial-bio">
                        <div class="testimonial-pic">
                            <img src="./images/test-2.jpg" alt="Testimonial Giver">
                        </div>
                        <div class="testimonial-name">
                            <h6>Mary Jane Monroe</h6>
                            <h7>Client for freelance project</h7>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <h5 class="hidden">Testimonial Card 3</h5>
                    <h6 class="testimonial-quote-mark">"</h6>

                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam, nihil velit? Necessitatibus, nulla aliquam illum quos fugit quo. Placeat maiores doloribus quos molestiae totam dolorum? Pariatur ex enim nesciunt modi dolores illum, vero deleniti sequi quas aut tenetur optio fugiat.
                    </p>
    
                    <div class="testimonial-bio">
                        <div class="testimonial-pic">
                            <img src="./images/test-3.jpg" alt="Testimonial Giver">
                        </div>
                        <div class="testimonial-name">
                            <h6>James Dean</h6>
                            <h7>Professor at UFSC</h7>
                        </div>
                    </div>
                </div>

                <div class="testimonial-controls col-span-full">
                    <h5 class="hidden">Testimonial Navigation</h5>
                    <button class="testimonial-button" id="test-prev-btn">&#10094;</button>
                    <button class="testimonial-button" id="test-next-btn">&#10095;</button>
                </div>
            </div>
        </section>

        <!-- Tools Section -->
        <section class="home-tools grid-con">
            <h3 class="col-span-full">My Favorite Tools</h3>

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
                    </div>
                </div>


                <div class="tools-item">
                    <div class="tools-btn">
                        <h5 class="small-button">Coding</h5>
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
                            <h6>Javascript</h6>
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
                        <h5 class="small-button">Languages</h5>
                        <i class="fa-solid fa-square-caret-right arrow"></i>
                    </div>
                    <div class="tools-open">
                        <div class="tool">
                            <img src="./images/brazil-flag.svg" alt="Brazilian flag" class="skill-icon">
                            <h6>Portuguese (native)</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/uk-flag.svg" alt="UK flag" class="skill-icon">
                            <h6>English (fluent)</h6>
                        </div>
                        <div class="tool">
                            <img src="./images/spain-flag.svg" alt="Spanish flag" class="skill-icon">
                            <h6>Spanish (intermediary)</h6>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section grid-con">
            <h3 class="col-span-full">Let's bring your ideas to life?</h3>
    
            <div class="redux-form-section col-span-full">
                <h4 class="hidden">Contact Form</h4>
                <form class="form" method="post" enctype="text/plain">
                    <input name="name" type="text"  placeholder="Full Name">
                    <input name="email" type="email" placeholder="E-mail Address">
                    <input name="message" type="text"  placeholder="Subject">
                    <button name="submit" type="submit" value="Send"><span>Submit</span></button>
                </form>
            </div>

            <div id="popup" class="popup">
                <h3 class="hidden">Newsletter Form Confirmation Popup</h3>
                <div class="popup-content">
                    <span class="close-btn">&times;</span>
                    <img src="./images/icon-white.svg" alt="Icon Confirmatoin Email">
                    <h4><i class="fa-solid fa-check"></i> Your form was sent!</h4>
                    <p>Your message is in my inbox, and I'll get back to you within 24 hours. Thanks for reaching out!</p>
                    <p><span>Talk to you soon!</span></p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="grid-con">
            <h3 class="hidden">Footer</h3>

            <div class="footer-copy col-span-full m-col-start-1 l-col-start-1 l-col-end-6">
                <h4 class="hidden">Copyright Information</h4>
                <a href="index.php"><img src="./images/icon-white.svg" alt="Henrique Gamborgi Symbol"></a>
                <h5>2024 Copyright &copy;</h5>
                <h5>Henrique Gamborgi Design</h5>
            </div>

            <div class="footer-social col-span-full m-col-start-1 l-col-start-9">
                <h4 class="hidden">Links</h4>

                <div class="footer-social-media">
                    <a href="https://github.com/ickgamborgi/" target="_blank">
                        <div class="social-media-item">
                            <h5 class="hidden">GitHub</h5>
                            <img src="./images/github.svg" alt="GitHub icon" class="social-media-icon">
                        </div>
                    </a>
    
                    <a href="https://behance.com/ickgamborgi" target="_blank">
                        <div class="social-media-item">
                            <h5 class="hidden">Behance</h5>
                            <img src="./images/behance.svg" alt="Behance icon" class="social-media-icon">
                        </div>
                    </a>
    
                    <a href="https://instagram.com/inkgamborgi" target="_blank">
                        <div class="social-media-item">
                            <h5 class="hidden">Instagram</h5>
                            <img src="./images/instagram.svg" alt="Instagram icon" class="social-media-icon">
                        </div>
                    </a>
    
                    <a href="https://linkedin.com/in/ickgamborgi/" target="_blank">
                        <div class="social-media-item">
                            <h5 class="hidden">LinkedIn</h5>
                            <img src="./images/linkedin.svg" alt="LinkedIn icon" class="social-media-icon">
                        </div>
                    </a>
                </div>
                
                <div class="footer-resume">
                    <a href="https://drive.google.com/file/d/1IVieGaWlVBvap9UwNIM0GwgP0hnsdKhI/view?usp=sharing" class="resume" target="_blank">
                        <h5 class="small-button">Resume</h5>
                        <i class="fa-solid fa-square-caret-right arrow"></i>
                    </a>
                </div>

            </div>
        </footer>

    </main>
</body>

</html>
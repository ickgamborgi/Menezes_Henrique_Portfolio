<!DOCTYPE html>
<html lang="en">

<?php
//conect to the running database server and the specific database EX: $connect = new mysqli('localhost','root','root','bookstore');
require_once('includes/connect.php');

//create a query to run in SQL
$query = 'SELECT * FROM project,media WHERE project_id = project.id AND project.id ='.$_GET['id'];

 //run the query to get back the content
$results = mysqli_query($connect,$query);
// print_r($results);

$row = mysqli_fetch_assoc($results);

$mediaquery = 'SELECT * FROM project,media WHERE project_id = project.id AND project.id ='.$_GET['id'];
$mediaresults = mysqli_query($connect, $mediaquery);

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
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script> <!-- link to greensock main library and scroll plugin -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/ScrollTrigger.js"></script>
    <script defer src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script defer src="js/main.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/icon-white.svg">

    <!-- Document Title -->
    <title>Henrique Gamborgi: Case Study</title> 
</head>

<!-- Documemnt Body -->
<body>
    <h1 class="hidden">Henrique Gamborgi: Case Study</h1>

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
                        <li><a href="about.php" class="nav-item"><h5>About</h5></a></li>
                        <li><a href="contact.php" class="nav-item"><h5>Contact</h5></a></li>
                        <li><a href="https://drive.google.com/file/d/1IVieGaWlVBvap9UwNIM0GwgP0hnsdKhI/view?usp=sharing" target="_blank" class="nav-item"><h5>Resume</h5></a></li>

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

                <?php
                while($media = mysqli_fetch_assoc($mediaresults)) {
                echo '
                <img src="./images/'.$media['url'].'" alt="Project Media Asset" class="project-media-image">
                ';
                }?>
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

                <div class="testimonial-card visible">
                    <h5 class="hidden">Testimonial Card 1</h5>
                    <h6 class="testimonial-quote-mark">"</h6>
                    <p>Henrique is a distinguished professional. His approach to challenges is always positive and stimulating. We worked together through several projects, including university, junior enterprise and market. He is extremely dedicated and engaged, always eager to learn and reach high-quality results.</p>
                    <div class="testimonial-bio">
                        <div class="testimonial-pic">
                            <img src="./images/test-gabriel.jpeg" alt="Testimonial Giver">
                        </div>
                        <div class="testimonial-name">
                            <h6>Gabriel Albrecht</h6>
                            <h7>Colleague and business partner</h7>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <h5 class="hidden">Testimonial Card 2</h5>
                    <h6 class="testimonial-quote-mark">"</h6>
                    <p>Working with Henrique has always been a great pleasure. His type of work is rare: fast, precise and high-quality. Not only we made dozens of university projects together, we also shared many professional experiences. I always felt (and still do) that Henrique is the type of person you can rely any project on. He is not only an awesome designer, but a remarkable human being!</p>
    
                    <div class="testimonial-bio">
                        <div class="testimonial-pic">
                            <img src="./images/test-joaopedro.jpeg" alt="Testimonial Giver">
                        </div>
                        <div class="testimonial-name">
                            <h6>João Pedro Ribas</h6>
                            <h7>Colleague and former client</h7>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <h5 class="hidden">Testimonial Card 3</h5>
                    <h6 class="testimonial-quote-mark">"</h6>

                    <p>I had the opportunity to work with Henrique in different situations. First, when I was his professor at UFSC, where he already showed to be intelligent, committed, creative and with an excellent business thinking. After that, we worked together in an international project. On that occasion, in the addition of the requirements for the position: design, marketing and english communication, Henrique also demonstrated to be very professional, a people person and with great proactivity.</p>
    
                    <div class="testimonial-bio">
                        <div class="testimonial-pic">
                            <img src="./images/test-julio.jpeg" alt="Testimonial Giver">
                        </div>
                        <div class="testimonial-name">
                            <h6>Júlio Monteiro</h6>
                            <h7>Former client and professor</h7>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <h5 class="hidden">Testimonial Card 4</h5>
                    <h6 class="testimonial-quote-mark">"</h6>

                    <p>Working with Henrique has been a source of great pride and knowledge! Besides being an unique person, he is experienced in lots of areas, including design, UX/UI, marketing and strategy — he takes care of his client's business as if it were his own. The numbers and results we eventually achieved can prove Henrique's performance and dedication.</p>
    
                    <div class="testimonial-bio">
                        <div class="testimonial-pic">
                            <img src="./images/test-rafael.jpeg" alt="Testimonial Giver">
                        </div>
                        <div class="testimonial-name">
                            <h6>Rafael Del Frari</h6>
                            <h7>Colleague and Business partner</h7>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card">
                    <h5 class="hidden">Testimonial Card 5</h5>
                    <h6 class="testimonial-quote-mark">"</h6>

                    <p>Henrique was always very talented and engaged! During the time we worked together, both at University and in business, it was easy to witness the quality of his work: polished, well-thought and incredible. All fruit os his effort and dedication to design. He is very open and can navigate with knowledge the unpredictable paths of the deep creative processes of any project!</p>
    
                    <div class="testimonial-bio">
                        <div class="testimonial-pic">
                            <img src="./images/test-gustavo.jpeg" alt="Testimonial Giver">
                        </div>
                        <div class="testimonial-name">
                            <h6>Gustavo Silva</h6>
                            <h7>Colleague and former client</h7>
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

        <!-- Contact Section -->
        <section class="contact-section grid-con">
            <h3 class="col-span-full">Let's bring your ideas to life?</h3>
    
            <div class="redux-form-section col-span-full">
                <h4 class="hidden">Contact Form</h4>
                <form class="form" method="post" action="sendmail.php">
                    <input name="name" type="text" required placeholder="Full Name">
                    <input name="email" type="email" required placeholder="E-mail Address">
                    <input name="message" type="text"  placeholder="Subject">
                    <button name="submit" type="submit" value="Send"><span>Submit</span></button>
                </form>
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
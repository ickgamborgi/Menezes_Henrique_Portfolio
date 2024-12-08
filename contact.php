<!DOCTYPE html>
<html lang="en">

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
    <title>Henrique Gamborgi: Contact</title> 
</head>

<!-- Documemnt Body -->
<body>
    <h1 class="hidden">Henrique Gamborgi: Contact</h1>

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

        <section class="full-width-grid-con banner" id="contact-banner">
            <div class="full-width-grid-con banner-cover"></div>
            
            <div class="col-span-full banner-title">
                <h3 class="col-span-4"><span>Contact Me</span></h3>
                <div class="col-span-4 banner-divisory" id="contact-divisory"></div>
                <a href="https://api.whatsapp.com/send?phone=12263860514&text=Hello,%20Henrique!%20I%27ve%20just%20seen%20your%20portfolio%20and..." target="_blank" class="banner-btn col-span-3">
                    <h4 class="small-button">Text me on WhatsApp</h4>
                </a>
            </div>
        </section>

        <section class="grid-con" id="contact-form">
            <h3 class="hidden">Contact Form</h3>
            <h4 class="col-span-4 m-col-span-7">Fill the form below</h4>
            <p class="col-span-4 m-col-span-7">Let's collaborate! Leave your ideas here, I'll get in touch as soon as possible! You can message me to discuss your project, opportunities or simply to connect.</p>
            <p class="col-span-4 m-col-span-7"><span>Looking forward to hearing from you!</span></p>

            <div class="form-section col-span-4 m-col-span-8">
                <h4 class="hidden">Contact Form</h4>
                <form class="form" method="post" action="sendmail.php">
                    <input name="name" type="text" required  placeholder="Full Name">
                    <input name="email" type="email" required placeholder="E-mail Address">
                    <input name="phone" type="tel"  placeholder="Phone Number">
                    <textarea name="message" placeholder="Insert your message or ideas here..."></textarea>
                    <button name="submit" type="submit" value="Send"><span>Submit</span></button>
                </form>
            </div>

            <div class="project-thank col-span-full">
                <img src="./images/illustration-3.webp" alt="Thank You Humaaan" class="thank-you">
                <div class=back-wrap>
                    <h4>Talk to you soon!</h4>
                    <a href="index.php" class="back-btn col-span-3">
                            <h5 class="small-button">Back to Homepage</h5>
                    </a>
                </div>
            </div>

        </section>

                <!-- Testimonials Section -->
        <section class="testimonials grid-con" id="contact-test">
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
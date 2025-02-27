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
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script> <!-- link to greensock main library and scroll plugin -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.0/ScrollTrigger.js"></script>
    <script defer src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script defer src="js/main.js"></script>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/icon-white.svg">

    <!-- Document Title -->
    <title>Henrique Gamborgi: About</title> 
</head>

<!-- Documemnt Body -->
<body>
    <h1 class="hidden">Henrique Gamborgi: About</h1>

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

        <section class="full-width-grid-con banner" id="about-banner">
            <div class="full-width-grid-con banner-cover"></div>
            
            <div class="banner-about-wrap col-span-full">
                <img src="./images/about-profile.jpg" alt="Henrique's About Me Picture">

                <div class="col-span-full banner-title">
                    <h3 class="col-span-6"><span>About Me</span></h3>
                    <div class="col-span-6 banner-divisory" id="about-divisory"></div>
                    <a href="https://drive.google.com/file/d/1IVieGaWlVBvap9UwNIM0GwgP0hnsdKhI/view?usp=sharing" target="_blank" class="banner-btn col-span-3">
                        <h4 class="small-button">Visit My Resume</h4>
                    </a>
                </div>
            </div>
        </section>


        <!-- About Section -->
        <section class="bio grid-con bio">
            <h3 class="hidden">About Section</h3>

            
            <div class="col-span-full subtitle-wrap">
                <h4>Live In</h4>
                <div>
                    <img src="./images/canada-flag.svg" alt="Canada Flag">
                    <h5>London, ON, Canada</h5>
                </div>
            </div>

            <div class="col-span-full subtitle-wrap">
                <h4>From</h4>
                <div>
                    <img src="./images/brazil-flag.svg" alt="Canada Flag">
                    <h5>Florianópolis, SC, Brasil</h5>
                </div>
            </div>

            <div class="col-span-full l-col-end-7 bio-text">
                <h4>Hello there, I'm Henrique!</h4>
                <p>
                    <span>I'm a passionate designer from Brasil, who not only loves studying, but never forgot that child whose drawings would change the world.</span> My creative dreams always empowered me to bring ideas to life, and I absolutely love understanding why and how people interact with products, technologies and media. While my curious mindset wonders about these experiences, my designer side wants to create. And before I even knew it had a name, I fell in love and grew fascinated with design. Today, I have more than 6 years of experience in the design market. I started my studies at the Federal University of Santa Catarina (UFSC), where I graduated as a graphic designer, with main focus on building and managing brands.
                </p>
            </div>

            <div class="col-span-full l-col-start-8 bio-text">
                <p>
                    After that, I adventured myself taking part on a few freelance projects, which also gave me great knowledge on marketing and sale strategies. In 2023, my journey led me to Canada, where I currently study Interactive Media Design at Fanshawe College. Throughout these years, I have proudly worked in many projects, and capacitated myself to become a rare type of breed, a designer that loves branding, UX, marketing, coding, video editing, motion, print and project management. It is true, design is my passion!
                </p>
            </div>

            <div class="col-span-full l-col-end-7 bio-images">
                <div class="bio-image" id="bio-image-1">
                    <div class="bio-cover"></div>
                    <p>First Winter in Canada</p>
                </div>
                <div class="bio-image" id="bio-image-2">
                    <div class="bio-cover"></div>
                    <p>Graduation at UFSC</p>
                </div>
                <div class="bio-image" id="bio-image-3">
                    <div class="bio-cover"></div>
                    <p>Day of my marriage</p>
                </div>
            </div>

            <div class="col-span-full l-col-start-8 bio-hobbies">
                <h4>In my spare time, I love</h4>
                <div class="hobbies-list">
                    <h5><span>&#x1F3AC;</span> Movies &amp; TV</h5>
                    <h5><span>&#x1F3A7;</span> All kinds of music</h5>
                    <h5><span>&#x1F94A;</span> Mixed Martial Arts</h5>
                    <h5><span>&#x1F60E;</span> Design &amp; Coding</h5>
                    <h5><span>&#x1F33A;</span> Gardening</h5>
                    <h5><span>&#x1F30D;</span> Traveling</h5>
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

            <div class="project-thank col-span-full">
                <img src="./images/illustration-4.webp" alt="Thank You Humaaan" class="thank-you">
                <div class=back-wrap>
                    <h4>Or if you prefer, here's a fancy piece of paper</h4>
                    <a href="https://drive.google.com/file/d/1IVieGaWlVBvap9UwNIM0GwgP0hnsdKhI/view?usp=sharing" target="_blank" class="back-btn col-span-3">
                            <h5 class="small-button">Visit My Resume</h5>
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
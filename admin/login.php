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
    <title>Portfolio Admin Login</title> 
</head>

<body>
    <h1 class="hidden">Portfolio Admin Login</h1>

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
                        <li><a href="project_list.php" class="nav-item"><h5>Admin <i class="fas fa-gear icon-gear"></i></h5></a></li>
                        <li><a href="logout.php" class="nav-item"><h5>Logout <i class="fas fa-sign-out icon-logout"></i></h5></a></li>
                    </ul>
                </div>
            </nav>
        </header>
    </div>

    <main>
       <section class="admin-section grid-con">
            <div class="login-form col-span-full">
                <h2 class="col-span-full"><i class="fas fa-unlock icon-unlock"></i>Log-in</h2>
                <form action="log.php" method="post">
                    <label class="form-label" for="username">Username: </label>
                    <input type="text" name="username" id="username"><br>

                    <label class="form-label" for="password">Password: </label>
                    <input type="password" name="password" id="password"><br>

                    <input type="submit" value="Access" id="submit-button">
                </form>
                <p>This is a restricted area of my website. If you need any help, reach me in my <a href="../contact.php" target="_blank">Contact Page</a></p>
            </div>

            <div class="logout-button col-span-full">
                    <a href="../index.php"><h5>Switch to User Page</h5></a>
                </div>
        </section>

    </main>
</body>
</html>

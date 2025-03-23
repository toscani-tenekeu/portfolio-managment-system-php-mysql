<?php
require '../dashboard/functions/auth_devices_compatibility.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 styles-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
     integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 

    <!-- Custom style -->
    <link rel="stylesheet" href="../assets/css/main.css">


    <title>Portfolio website | skills</title>
</head>
<body>
    <header class="header container-fluid">
        <nav class="nav">
            <p>Portflio website using PHP + MySQL</p>
            <button>Login as admin</button>
        </nav>
        
    </header>
    <main class="main container-fluid">
        <div class="left-side">
            <div class="navigation-link">
                <a href="./standard_main.php">About</a>
                <a href="./standard_skills.php" class="active">Skills</a>
                <a href="./standard_experiences.php">Experiences</a>
                <a href="./standard_projects.php">Projects</a>
                <a href="./standard_contacts.php">Contacts</a>
            </div>
        </div>
        <div class="right-side">
            <h1 class="text-dark mb-5" style="font-size: 4.5rem; font-weight: bolder;">My Skills</h1>
            
            <div class="row w-100 g-5">
                <!-- Frontend Skills -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-lg">
                        <div class="card-body p-4">
                            <h2 class="card-title text-success mb-4" style="font-size: 2.5rem;">Frontend</h2>
                            <ul class="list-unstyled">
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fab fa-html5 me-3" style="font-size: 2rem;"></i> HTML5
                                </li>
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fab fa-css3-alt me-3" style="font-size: 2rem;"></i> CSS3
                                </li>
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fab fa-js me-3" style="font-size: 2rem;"></i> JavaScript
                                </li>
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fab fa-react me-3" style="font-size: 2rem;"></i> React.js
                                </li>
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fab fa-bootstrap me-3" style="font-size: 2rem;"></i> Bootstrap
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Backend Skills -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-lg">
                        <div class="card-body p-4">
                            <h2 class="card-title text-success mb-4" style="font-size: 2.5rem;">Backend</h2>
                            <ul class="list-unstyled">
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fab fa-php me-3" style="font-size: 2rem;"></i> PHP
                                </li>
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fab fa-node-js me-3" style="font-size: 2rem;"></i> Node.js
                                </li>
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fas fa-database me-3" style="font-size: 2rem;"></i> MySQL
                                </li>
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fas fa-server me-3" style="font-size: 2rem;"></i> RESTful APIs
                                </li>
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fas fa-lock me-3" style="font-size: 2rem;"></i> Authentication
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Other Skills -->
                <div class="col-md-4">
                    <div class="card h-100 shadow-lg">
                        <div class="card-body p-4">
                            <h2 class="card-title text-success mb-4" style="font-size: 2.5rem;">Other Skills</h2>
                            <ul class="list-unstyled">
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fab fa-git-alt me-3" style="font-size: 2rem;"></i> Git
                                </li>
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fab fa-docker me-3" style="font-size: 2rem;"></i> Docker
                                </li>
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fas fa-cloud me-3" style="font-size: 2rem;"></i> Cloud Computing
                                </li>
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fas fa-shield-alt me-3" style="font-size: 2rem;"></i> Cybersecurity
                                </li>
                                <li class="mb-4" style="font-size: 1.3rem;">
                                    <i class="fas fa-laptop-code me-3" style="font-size: 2rem;"></i> Problem Solving
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer container-fluid">
        <em class="text-white" style="font-size: 1.5rem;">Made with love by Toscani TENEKEU</em>
        <p class="text-white text-center">Feel free to use and customize it!</p>
    </footer>
    
    

    <!-- Bootstrap 5 script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
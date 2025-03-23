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


    <title>Portfolio website | Contacts</title>
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
                <a href="./standard_skills.php">Skills</a>
                <a href="./standard_experiences.php">Experiences</a>
                <a href="./standard_projects.php">Projects</a>
                <a href="./standard_contacts.php" class="active">Contacts</a>
            </div>
        </div>
        <div class="right-side">
            <h1 class="text-dark" style="font-size: 4.5rem; font-weight: bolder; margin-top: 3rem;">Contacts</h1>

            <form action="" method="post" style="width: 70%;" class=" d-flex flex-column justify-content-center">
                <div class="mb-3">
                    <input type="email" style="padding: 2rem 1rem;" class="form-control form-control-lg" id="formGroupExampleInput" placeholder="Email">
                </div>
                <div class="mb-3">
                    <textarea style="padding: 5rem 1rem; font-size: x-large;" class="form-control form-control-lg" id="formGroupExampleInput2" placeholder="Message"></textarea>
                </div>
                <button class="btn btn-lg btn-success d-flex gap-4 py-4 px-5 justify-content-center" type="submit">
                    <i class="fas fa-paper-plane" style="font-size: 3rem;"></i>
                    <label style="font-size: 2rem;">Send</label>
                </button>
            </form>
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
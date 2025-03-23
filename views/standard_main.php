<?php
require '../dashboard/functions/auth_devices_compatibility.php';
require '../db/connection.php';

// Get user information
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute(['toscanisoft@gmail.com']);
$user = $stmt->fetch();

if (!$user) {
    die('User not found');
}

// Get about information for this user
$stmt = $pdo->prepare("SELECT * FROM about WHERE user_id = ?");
$stmt->execute([$user['id']]);
$about = $stmt->fetch();

?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" width="device-width, initial-scale=1.0">

    <!-- Bootstrap 5 styles-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
     integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 

    <!-- Custom style -->
    <link rel="stylesheet" href="../assets/css/main.css">


    <title>Portfolio website</title>
</head>
<body>
    <header class="header container-fluid">
        <nav class="nav">
            <p>Portfolio website using PHP + MySQL</p>
                <button class="user-btn" type="button" id="userMenuButton" onclick="window.location.href='../dashboard/views/choice.php'">
                    <span>
                        Login
                    </span>
                </button>
        </nav>
    </header>
    <main class="main container-fluid">
        <div class="left-side">
            <div class="navigation-link">
                <a href="./standard_main.php" class="active">About</a>
                <a href="./standard_skills.php">Skills</a>
                <a href="./standard_experiences.php">Experiences</a>
                <a href="./standard_projects.php">Projects</a>
                <a href="./standard_contacts.php">Contacts</a>
            </div>
        </div>
        <div class="right-side">
            <p class="text-dark text-wrap mt-5" style="font-size: 4rem; font-weight: bolder;">
                Hi, I'm <?= htmlspecialchars($about['full_name']) ?> - <?= htmlspecialchars($about['title']) ?>
            </p>
            <p class="text-white" style="font-size: large; font-weight: bold; margin-bottom: 6rem;">
                <?= nl2br(htmlspecialchars($about['description'])) ?>
            </p>
            <div class="w-full d-flex align-items-center justify-content-center gap-4">
                <a href="<?= htmlspecialchars($about['cv_link']) ?>" class="btn btn-outline-success gap-4 py-4 px-5" download>
                    <label style="font-size: 1.5rem;">Download my CV</label>
                    <i class="fas fa-download" style="font-size: 3rem;"></i>
                </a>
                <a href="./standard_contacts.php" class="btn btn-outline-success gap-4 py-4 px-5">
                    <label style="font-size: 1.5rem;">Contact me</label>
                    <i class="fas fa-phone" style="font-size: 3rem;"></i>
                </a>
            </div>
        </div>
    </main>
    <footer class="footer container-fluid">
        <em class="text-white" style="font-size: 1.5rem;">Made with love by <?= htmlspecialchars($about['full_name']) ?></em>
        <p class="text-white text-center">Feel free to use and customize it!</p>
    </footer>
    
    

    <!-- Bootstrap 5 script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
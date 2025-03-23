<?php
require '../dashboard/functions/auth_view_mode.php';
require '../db/connection.php';
require '../dashboard/functions/auth_devices_compatibility.php';

session_start();

// Get user about information
$stmt = $pdo->prepare("SELECT * FROM about ORDER BY id DESC LIMIT 1");
$stmt->execute();
$about = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio website</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/main.css">

    <!-- Bootstrap JS (place before closing body tag) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <header class="header container-fluid">
        <nav class="nav">
            <p>Portfolio website using PHP + MySQL</p>
            <div class="dropdown">
                <button class="dropdown-toggle user-btn" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php if(isset($_SESSION['user_full_name'])): ?>
                        <?= $_SESSION['user_full_name'] ?> <i class='fas fa-user' style='font-size: 2rem;'></i>
                    <?php else: ?>
                        Welcome back ! <i class='fas fa-user' style='font-size: 2rem;'></i>
                    <?php endif; ?>
                </button>
                <ul style="padding: 2rem; font-size: 2rem;" class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuButton">
                    <?php if(isset($_SESSION['user_full_name'])): ?>
                        <li><a class="dropdown-item" href="../dashboard/views/main.php">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="../dashboard/functions/logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a></li>
                    <?php else: ?>
                        <li><a class="dropdown-item" href="../dashboard/views/login.php">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a></li>
                        <li><a class="dropdown-item" href="../dashboard/views/sign_up.php">
                            <i class="fas fa-user-plus me-2"></i>Sign Up
                        </a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>
    <main class="main container-fluid">
        <div class="left-side">
            <div class="navigation-link">
                <a href="./main.php" class="active">About</a>
                <a href="./skills.php">Skills</a>
                <a href="./experiences.php">Experiences</a>
                <a href="./projects.php">Projects</a>
            
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
                <a href="" class="btn btn-outline-success gap-4 py-4 px-5">
                    <label style="font-size: 1.5rem;">Deploy my portfolio</label>
                    <i class="fas fa-cloud" style="font-size: 3rem;"></i>
                </a>
            
            </div>
        </div>
    </main>
    <footer class="footer container-fluid">
        <em class="text-white" style="font-size: 1.5rem;">Made with love by Toscani TENEKEU</em>
        <p class="text-white text-center">Feel free to use and customize it!</p>
    </footer>
</body>
</html>
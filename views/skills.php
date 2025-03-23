<?php
require '../dashboard/functions/auth_view_mode.php';
require '../db/connection.php';
require '../dashboard/functions/auth_devices_compatibility.php';

session_start();

// Get all categories with their skills
$stmt = $pdo->query("SELECT sc.category_name, s.skill_name, s.icon 
                     FROM skills_categories sc 
                     LEFT JOIN skills s ON sc.id = s.category_id 
                     ORDER BY sc.id, s.id");
$allSkills = $stmt->fetchAll();

// Group skills by category
$skillsByCategory = [];
foreach($allSkills as $skill) {
    $skillsByCategory[$skill['category_name']][] = $skill;
}
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
            <p>Portfolio website using PHP + MySQL</p>
            <div class="dropdown">
                <button class="dropdown-toggle user-btn" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        <?php echo isset($_SESSION['user_full_name']) ? $_SESSION['user_full_name']." "."<i class='fas fa-user' style='font-size: 2rem;'></i>" : "Welcome back !"; ?>
                    </span>
                </button>
                <?php if(isset($_SESSION['user_full_name'])): ?>
                    <ul style="padding: 2rem; font-size: 2rem;" class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuButton">
                        <li><a class="dropdown-item" href="../dashboard/views/main.php">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="../dashboard/functions/logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a></li>
                    </ul>
                <?php else: ?>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuButton">
                        <li><a class="dropdown-item" href="../dashboard/views/login.php">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a></li>
                        <li><a class="dropdown-item" href="../dashboard/views/sign_up.php">
                            <i class="fas fa-user-plus me-2"></i>Sign Up
                        </a></li>
                    </ul>
                <?php endif; ?>
            </div>
        </nav>
        
    </header>
    <main class="main container-fluid">
        <div class="left-side">
            <div class="navigation-link">
                <a href="./main.php">About</a>
                <a href="./skills.php" class="active">Skills</a>
                <a href="./experiences.php">Experiences</a>
                <a href="./projects.php">Projects</a>
              
            </div>
        </div>
        <div class="right-side">
            <h1 class="text-dark mb-5" style="font-size: 4.5rem; font-weight: bolder;">My Skills</h1>
            <div class="row w-100 g-5">
                <?php foreach($skillsByCategory as $category => $skills): ?>
                    <div class="col-md-4">
                        <div class="card h-auto shadow-lg">
                            <div class="card-body p-4">
                                <h2 class="card-title text-success mb-4" style="font-size: 2.5rem;">
                                    <?= htmlspecialchars($category) ?>
                                </h2>
                                <ul class="list-unstyled">
                                    <?php foreach($skills as $skill): ?>
                                        <?php if($skill['skill_name']): ?>
                                            <li class="mb-4" style="font-size: 1.3rem;">
                                                <i class="<?= htmlspecialchars($skill['icon']) ?> me-3" style="font-size: 2rem;"></i>
                                                <?= htmlspecialchars($skill['skill_name']) ?>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
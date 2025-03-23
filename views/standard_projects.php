<?php
require '../dashboard/functions/auth_devices_compatibility.php';
require '../db/connection.php';

// Get user information
$stmt = $pdo->prepare("SELECT id, full_name FROM users WHERE email = ?");
$stmt->execute(['toscanisoft@gmail.com']);
$user = $stmt->fetch();

if (!$user) {
    die('User not found');
}

// Get projects information for this user
$stmt = $pdo->prepare("SELECT * FROM projects WHERE user_id = ? ORDER BY date DESC");
$stmt->execute([$user['id']]);
$projects = $stmt->fetchAll();
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


    <title>Portfolio website | Projects</title>
</head>
<body>
    <header class="header container-fluid">
        <nav class="nav">
            <p>Portfolio website using PHP + MySQL</p>
            <button class="user-btn" type="button" id="userMenuButton" onclick="window.location.href='../dashboard/views/choice.php'">
                <span>Login</span>
            </button>
        </nav>
    </header>
    <main class="main container-fluid">
        <div class="left-side">
            <div class="navigation-link">
                <a href="./standard_main.php">About</a>
                <a href="./standard_skills.php">Skills</a>
                <a href="./standard_experiences.php">Experiences</a>
                <a href="./standard_projects.php" class="active">Projects</a>
                <a href="./standard_contacts.php">Contacts</a>
            </div>
        </div>
        <div class="right-side">
            <h1 class="text-dark mb-5" style="font-size: 4.5rem; font-weight: bolder;">My Projects</h1>
            
            <div class="row w-100 g-5">
                <?php foreach($projects as $project): ?>
                    <div class="col-md-6">
                        <div class="card h-auto shadow-lg">
                            <div class="card-body p-4">
                                <h3 class="card-title text-success" style="font-size: 2.5rem;">
                                    <?= htmlspecialchars($project['title']) ?>
                                </h3>
                                <p class="card-text my-4" style="font-size: 1.2rem;">
                                    <?= htmlspecialchars($project['description']) ?>
                                </p>
                                <div class="mb-4">
                                    <?php foreach(explode(',', $project['tech_stack']) as $tech): ?>
                                        <span class="badge bg-secondary me-2 p-2" style="font-size: 1.1rem;">
                                            <?= htmlspecialchars(trim($tech)) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <div class="d-flex gap-4">
                                    <a href="<?= htmlspecialchars($project['soucre_code_link']) ?>" 
                                       class="btn btn-outline-success py-3 px-4" target="_blank">
                                        <i class="fab fa-github me-2" style="font-size: 1.5rem;"></i>
                                        <span style="font-size: 1.2rem;">View Code</span>
                                    </a>
                                    <a href="<?= htmlspecialchars($project['live_demo_link']) ?>" 
                                       class="btn btn-success py-3 px-4" target="_blank">
                                        <i class="fas fa-external-link-alt me-2" style="font-size: 1.5rem;"></i>
                                        <span style="font-size: 1.2rem;">Live Demo</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <footer class="footer container-fluid">
        <em class="text-white" style="font-size: 1.5rem;">Made with love by <?= htmlspecialchars($user['full_name']) ?></em>
        <p class="text-white text-center">Feel free to use and customize it!</p>
    </footer>
    
    

    <!-- Bootstrap 5 script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
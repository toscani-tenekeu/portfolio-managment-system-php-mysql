<?php
require '../functions/auth_manage_mode.php';
require '../../db/connection.php';
require '../functions/auth_devices_compatibility_dashb.php';
session_start();

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $cv_link = $_POST['cv_link'];
    $user_id = $_SESSION['user_id'];

    try {
        // Vérifier si un enregistrement existe déjà pour cet utilisateur
        $stmt = $pdo->prepare("SELECT id FROM about WHERE user_id = ?");
        $stmt->execute([$user_id]);
        $exists = $stmt->fetch();

        if ($exists) {
            // Update
            $stmt = $pdo->prepare("UPDATE about SET full_name = ?, title = ?, description = ?, cv_link = ? WHERE user_id = ?");
            $stmt->execute([$full_name, $title, $description, $cv_link, $user_id]);
        } else {
            // Insert
            $stmt = $pdo->prepare("INSERT INTO about (user_id, full_name, title, description, cv_link) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $full_name, $title, $description, $cv_link]);
        }
        $_SESSION['success'] = "About information updated successfully!";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error updating about information: " . $e->getMessage();
    }
    
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

    // Récupérer les données existantes pour l'utilisateur connecté
    $stmt = $pdo->prepare("SELECT * FROM about WHERE user_id = ? LIMIT 1");
    $stmt->execute([$_SESSION['user_id']]);
    $about = $stmt->fetch();

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


    <title>Portfolio website</title>
</head>
<body>
    <header class="header container-fluid">
    <nav class="nav">
            <p>ADMIN Dashboard</p>
            <div class="dropdown">
                <button class="dropdown-toggle user-btn" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        <?php echo isset($_SESSION['user_full_name']) ? $_SESSION['user_full_name']." "."<i class='fas fa-user' style='font-size: 2rem;'></i>" : "Welcome back !"; ?>
                    </span>
                </button>
                <?php if(isset($_SESSION['user_full_name'])): ?>
                    <ul style="padding: 2rem; font-size: 2rem;" class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuButton">
                        <li><a class="dropdown-item" href="../../views/standard_main.php">
                            <i class="fas fa-tachometer-alt me-2"></i>Return to standard view
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="../dashboard/functions/logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a></li>
                    </ul>
                <?php else: ?>
                    <ul style="padding: 2rem; font-size: 2rem;" class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuButton">
                        <li><a class="dropdown-item" href="./login.php">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a></li>
                        <li><a class="dropdown-item" href="./sign_up.php">
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
                <a href="./main.php" class="active">About</a>
                <a href="./skills.php">Skills</a>
                <a href="./experiences.php">Experiences</a>
                <a href="./projects.php">Projects</a>
                <a href="./contacts.php">Contacts</a>
            </div>
        </div>
        <div class="right-side">
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="text-center text-lg container-fluid">
                <form action="" method="POST" class="form-control shadow-md p-5">
                    <input type="text" name="full_name" id="full_name" class="form-control mb-2" 
                           placeholder="Full name" value="<?= htmlspecialchars($about['full_name'] ?? '') ?>">
                    
                    <input type="text" name="title" id="title" class="form-control mb-2" 
                           placeholder="Your job title ex: Full-Stack Developer" value="<?= htmlspecialchars($about['title'] ?? '') ?>">
                    
                    <textarea rows="7" name="description" id="description" class="form-control mb-2" 
                              placeholder="Talk us more about you (little Biographie)"><?= htmlspecialchars($about['description'] ?? '') ?></textarea>
                    
                    <input type="text" name="cv_link" id="cv_link" class="form-control mb-2"
                           placeholder="Where is your cv located? (Give the path ex: ../assets/file/cv.pdf)" 
                           value="<?= htmlspecialchars($about['cv_link'] ?? '') ?>">
                    
                    <button type="submit" class="btn btn-outline-success mt-5">Update</button>
                </form>
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
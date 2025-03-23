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

// Get experiences information for this user
$stmt = $pdo->prepare("SELECT * FROM experiences WHERE user_id = ? ORDER BY start_date DESC");
$stmt->execute([$user['id']]);
$experiences = $stmt->fetchAll();

// Get user name for footer
$stmt = $pdo->prepare("SELECT full_name FROM users WHERE id = ?");
$stmt->execute([$user['id']]);
$userData = $stmt->fetch();
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
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom style -->
    <link rel="stylesheet" href="../assets/css/main.css">


    <title>Portfolio website | Experiences</title>
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
                <a href="./standard_experiences.php" class="active">Experiences</a>
                <a href="./standard_projects.php">Projects</a>
                <a href="./standard_contacts.php">Contacts</a>
            </div>
        </div>
        <div class="right-side">
            <h1 class="text-dark mb-5" style="font-size: 4.5rem; font-weight: bolder; margin-top: 3rem;">
                <i class="fas fa-briefcase me-3"></i>My Experience
            </h1>

            <div class="timeline w-100">
                <?php foreach($experiences as $experience): ?>
                    <div class="card mb-5 shadow-lg">
                        <div class="card-body p-4">
                            <h3 class="card-title text-success" style="font-size: 2.5rem;">
                                <i class="<?= htmlspecialchars($experience['title_icon']) ?> me-3"></i>
                                <?= htmlspecialchars($experience['title']) ?>
                            </h3>
                            <h4 class="card-subtitle mb-3 text-muted" style="font-size: 1.8rem;">
                                <i class="<?= htmlspecialchars($experience['company_icon']) ?> me-3"></i>
                                <?= htmlspecialchars($experience['company']) ?>
                            </h4>
                            <p class="card-text text-muted mb-4" style="font-size: 1.3rem;">
                                <i class="fas fa-calendar-alt me-3"></i>
                                <?= date('F Y', strtotime($experience['start_date'])) ?> - 
                                <?= $experience['end_date'] ? date('F Y', strtotime($experience['end_date'])) : 'Present' ?>
                            </p>
                            <div class="tasks-description" style="font-size: 1.3rem;">
                                <?= nl2br(htmlspecialchars($experience['tasks_description'])) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <footer class="footer container-fluid">
        <em class="text-white" style="font-size: 1.5rem;">Made with love by <?= htmlspecialchars($userData['full_name']) ?></em>
        <p class="text-white text-center">Feel free to use and customize it!</p>
    </footer>

    <!-- Bootstrap 5 script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>
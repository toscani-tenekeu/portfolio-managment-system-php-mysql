<?php
require '../functions/auth_manage_mode.php';
require '../../db/connection.php';
require '../functions/auth_devices_compatibility_dashb.php'; 
$user_id = $_SESSION['user_id'];

// Delete Message
if(isset($_POST['delete_message'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ? AND user_id = ?");
        $stmt->execute([$_POST['message_id'], $user_id]);
        $_SESSION['success'] = "Message deleted successfully!";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

// Get User Messages
$stmt = $pdo->prepare("SELECT * FROM contacts WHERE user_id = ? ORDER BY id DESC");
$stmt->execute([$user_id]);
$messages = $stmt->fetchAll();
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
                <a href="./main.php">About</a>
                <a href="./skills.php">Skills</a>
                <a href="./experiences.php">Experiences</a>
                <a href="./projects.php">Projects</a>
                <a href="./contacts.php" class="active">Contacts</a>
            </div>
        </div>
        <div class="right-side">
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <!-- Display Messages -->
            <div class="card">
                <div class="card-header">
                    <h5>Contact Messages</h5>
                </div>
                <div class="card-body">
                    <?php if(empty($messages)): ?>
                        <p class="text-muted">No messages yet.</p>
                    <?php else: ?>
                        <?php foreach($messages as $message): ?>
                            <div class="message-item border-bottom p-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6>From: <?= htmlspecialchars($message['email']) ?></h6>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="message_id" value="<?= $message['id'] ?>">
                                        <button type="submit" name="delete_message" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                                <p class="mt-2"><?= nl2br(htmlspecialchars($message['message'])) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
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
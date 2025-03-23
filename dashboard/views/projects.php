<?php
require '../functions/auth_manage_mode.php';
require '../../db/connection.php';
require '../functions/auth_devices_compatibility_dashb.php'; 
$user_id = $_SESSION['user_id'];

// Add Project
if(isset($_POST['add_project'])) {
    try {
        $stmt = $pdo->prepare("INSERT INTO projects (user_id, title, description, tech_stack, soucre_code_link, live_demo_link) 
                              VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $user_id,
            $_POST['title'],
            $_POST['description'],
            $_POST['tech_stack'],
            $_POST['source_code_link'],
            $_POST['live_demo_link']
        ]);
        $_SESSION['success'] = "Project added successfully!";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

// Delete Project
if(isset($_POST['delete_project'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ? AND user_id = ?");
        $stmt->execute([$_POST['project_id'], $user_id]);
        $_SESSION['success'] = "Project deleted successfully!";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

// Update Project
if(isset($_POST['update_project'])) {
    try {
        $stmt = $pdo->prepare("UPDATE projects SET 
            title = ?, 
            description = ?, 
            tech_stack = ?, 
            soucre_code_link = ?, 
            live_demo_link = ? 
            WHERE id = ? AND user_id = ?");
        
        $stmt->execute([
            $_POST['title'],
            $_POST['description'],
            $_POST['tech_stack'],
            $_POST['source_code_link'],
            $_POST['live_demo_link'],
            $_POST['project_id'],
            $user_id
        ]);
        $_SESSION['success'] = "Project updated successfully!";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error updating project: " . $e->getMessage();
    }
}

// Get User Projects
$stmt = $pdo->prepare("SELECT * FROM projects WHERE user_id = ? ORDER BY date DESC");
$stmt->execute([$user_id]);
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
                <a href="./projects.php" class="active">Projects</a>
                <a href="./contacts.php">Contacts</a>
            </div>
        </div>
        <div class="right-side">
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <!-- Add Project Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Add New Project</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label>Project Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Technologies Used</label>
                            <input type="text" name="tech_stack" class="form-control" required 
                                   placeholder="e.g., PHP, MySQL, Bootstrap">
                        </div>
                        <div class="mb-3">
                            <label>Source Code Link</label>
                            <input type="url" name="source_code_link" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Live Demo Link</label>
                            <input type="url" name="live_demo_link" class="form-control" required>
                        </div>
                        <button type="submit" name="add_project" class="btn btn-success">Add Project</button>
                    </form>
                </div>
            </div>

            <!-- Display Projects -->
            <div class="card">
                <div class="card-header">
                    <h5>My Projects</h5>
                </div>
                <div class="card-body">
                    <?php foreach($projects as $project): ?>
                        <div class="project-item border-bottom p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5><?= htmlspecialchars($project['title']) ?></h5>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm" 
                                            onclick='openUpdateProjectModal(<?= json_encode($project) ?>)'>
                                        Update
                                    </button>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
                                        <button type="submit" name="delete_project" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-muted"><?= htmlspecialchars($project['description']) ?></p>
                            <p><strong>Tech Stack:</strong> <?= htmlspecialchars($project['tech_stack']) ?></p>
                            <div class="btn-group">
                                <a href="<?= htmlspecialchars($project['soucre_code_link']) ?>" class="btn btn-outline-primary btn-sm" 
                                   target="_blank">View Code</a>
                                <a href="<?= htmlspecialchars($project['live_demo_link']) ?>" class="btn btn-outline-success btn-sm" 
                                   target="_blank">Live Demo</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
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

    <!-- Add this modal before closing body tag -->
    <div class="modal fade" id="updateProjectModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="project_id" id="updateProjectId">
                        <div class="mb-3">
                            <label>Project Title</label>
                            <input type="text" name="title" id="updateTitle" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" id="updateDescription" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Technologies Used</label>
                            <input type="text" name="tech_stack" id="updateTechStack" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Source Code Link</label>
                            <input type="url" name="source_code_link" id="updateSourceLink" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Live Demo Link</label>
                            <input type="url" name="live_demo_link" id="updateDemoLink" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_project" class="btn btn-primary">Update Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add this JavaScript before closing body tag -->
    <script>
    function openUpdateProjectModal(project) {
        document.getElementById('updateProjectId').value = project.id;
        document.getElementById('updateTitle').value = project.title;
        document.getElementById('updateDescription').value = project.description;
        document.getElementById('updateTechStack').value = project.tech_stack;
        document.getElementById('updateSourceLink').value = project.soucre_code_link;
        document.getElementById('updateDemoLink').value = project.live_demo_link;
        new bootstrap.Modal(document.getElementById('updateProjectModal')).show();
    }
    </script>

</body>
</html>
<?php
require '../functions/auth_manage_mode.php';
require '../../db/connection.php';
require '../functions/auth_devices_compatibility_dashb.php'; 
$user_id = $_SESSION['user_id'];

// Add Experience
if(isset($_POST['add_experience'])) {
    try {
        $stmt = $pdo->prepare("INSERT INTO experiences (user_id, title, title_icon, company, company_icon, 
                              start_date, end_date, tasks_description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $user_id,
            $_POST['title'],
            $_POST['title_icon'],
            $_POST['company'],
            $_POST['company_icon'],
            $_POST['start_date'],
            !empty($_POST['end_date']) ? $_POST['end_date'] : null,
            $_POST['tasks_description']
        ]);
        $_SESSION['success'] = "Experience added successfully!";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

// Delete Experience
if(isset($_POST['delete_experience'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM experiences WHERE id = ? AND user_id = ?");
        $stmt->execute([$_POST['experience_id'], $user_id]);
        $_SESSION['success'] = "Experience deleted successfully!";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

// Update Experience
if(isset($_POST['update_experience'])) {
    try {
        $stmt = $pdo->prepare("UPDATE experiences SET 
            title = ?, 
            title_icon = ?, 
            company = ?, 
            company_icon = ?, 
            start_date = ?, 
            end_date = ?, 
            tasks_description = ? 
            WHERE id = ? AND user_id = ?");
        
        $stmt->execute([
            $_POST['title'],
            $_POST['title_icon'],
            $_POST['company'],
            $_POST['company_icon'],
            $_POST['start_date'],
            !empty($_POST['end_date']) ? $_POST['end_date'] : null,
            $_POST['tasks_description'],
            $_POST['experience_id'],
            $user_id
        ]);
        $_SESSION['success'] = "Experience updated successfully!";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error updating experience: " . $e->getMessage();
    }
}

// Get User Experiences
$stmt = $pdo->prepare("SELECT * FROM experiences WHERE user_id = ? ORDER BY start_date DESC");
$stmt->execute([$user_id]);
$experiences = $stmt->fetchAll();
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
                <a href="./experiences.php" class="active">Experiences</a>
                <a href="./projects.php">Projects</a>
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

            <!-- Add Experience Form -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Add New Experience</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Job Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Title Icon (Font Awesome class)</label>
                                <input type="text" name="title_icon" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Company</label>
                                <input type="text" name="company" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Company Icon (Font Awesome class)</label>
                                <input type="text" name="company_icon" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Start Date</label>
                                <input type="date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>End Date (leave empty if current)</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Tasks & Responsibilities</label>
                            <textarea name="tasks_description" class="form-control" rows="4" required></textarea>
                        </div>
                        <button type="submit" name="add_experience" class="btn btn-success">Add Experience</button>
                    </form>
                </div>
            </div>

            <!-- Display Experiences -->
            <div class="card">
                <div class="card-header">
                    <h5>My Experiences</h5>
                </div>
                <div class="card-body">
                    <?php foreach($experiences as $experience): ?>
                        <div class="experience-item border-bottom p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5>
                                    <i class="<?= htmlspecialchars($experience['title_icon']) ?>"></i>
                                    <?= htmlspecialchars($experience['title']) ?> at 
                                    <i class="<?= htmlspecialchars($experience['company_icon']) ?>"></i>
                                    <?= htmlspecialchars($experience['company']) ?>
                                </h5>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-sm" 
                                            onclick='openUpdateExperienceModal(<?= json_encode($experience) ?>)'>
                                        Update
                                    </button>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="experience_id" value="<?= $experience['id'] ?>">
                                        <button type="submit" name="delete_experience" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-muted">
                                <?= date('M Y', strtotime($experience['start_date'])) ?> - 
                                <?= $experience['end_date'] ? date('M Y', strtotime($experience['end_date'])) : 'Present' ?>
                            </p>
                            <p><?= nl2br(htmlspecialchars($experience['tasks_description'])) ?></p>
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

    <div class="modal fade" id="updateExperienceModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="experience_id" id="updateExperienceId">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Job Title</label>
                                <input type="text" name="title" id="updateTitle" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Title Icon</label>
                                <input type="text" name="title_icon" id="updateTitleIcon" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Company</label>
                                <input type="text" name="company" id="updateCompany" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Company Icon</label>
                                <input type="text" name="company_icon" id="updateCompanyIcon" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Start Date</label>
                                <input type="date" name="start_date" id="updateStartDate" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>End Date</label>
                                <input type="date" name="end_date" id="updateEndDate" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Tasks & Responsibilities</label>
                            <textarea name="tasks_description" id="updateTasks" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_experience" class="btn btn-primary">Update Experience</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script>
    function openUpdateExperienceModal(experience) {
        document.getElementById('updateExperienceId').value = experience.id;
        document.getElementById('updateTitle').value = experience.title;
        document.getElementById('updateTitleIcon').value = experience.title_icon;
        document.getElementById('updateCompany').value = experience.company;
        document.getElementById('updateCompanyIcon').value = experience.company_icon;
        document.getElementById('updateStartDate').value = experience.start_date;
        document.getElementById('updateEndDate').value = experience.end_date || '';
        document.getElementById('updateTasks').value = experience.tasks_description;
        new bootstrap.Modal(document.getElementById('updateExperienceModal')).show();
    }
    </script>

</body>

</html>
<?php
require '../functions/auth_manage_mode.php';
require '../../db/connection.php';
require '../functions/auth_devices_compatibility_dashb.php';
$user_id = $_SESSION['user_id'];

// Add Category
if(isset($_POST['add_category'])) {
    try {
        $stmt = $pdo->prepare("INSERT INTO skills_categories (category_name) VALUES (?)");
        $stmt->execute([$_POST['category_name']]);
        $_SESSION['success'] = "Category added successfully!";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

// Add Skill
if(isset($_POST['add_skill'])) {
    try {
        $stmt = $pdo->prepare("INSERT INTO skills (user_id, category_id, skill_name, icon) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $_POST['category_id'], $_POST['skill_name'], $_POST['icon']]);
        $_SESSION['success'] = "Skill added successfully!";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

// Update Skill
if(isset($_POST['update_skill'])) {
    try {
        $stmt = $pdo->prepare("UPDATE skills SET category_id = ?, skill_name = ?, icon = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([
            $_POST['category_id'],
            $_POST['skill_name'],
            $_POST['icon'],
            $_POST['skill_id'],
            $user_id
        ]);
        $_SESSION['success'] = "Skill updated successfully!";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

// Delete Skill
if(isset($_POST['delete_skill'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM skills WHERE id = ? AND user_id = ?");
        $stmt->execute([$_POST['skill_id'], $user_id]);
        $_SESSION['success'] = "Skill deleted successfully!";
    } catch(PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }
}

// Get Categories
$categories = $pdo->query("SELECT * FROM skills_categories")->fetchAll();

// Get User Skills
$stmt = $pdo->prepare("SELECT s.*, sc.category_name FROM skills s 
                       JOIN skills_categories sc ON s.category_id = sc.id 
                       WHERE s.user_id = ?");
$stmt->execute([$user_id]);
$skills = $stmt->fetchAll();
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
                <a href="./skills.php" class="active">Skills</a>
                <a href="./experiences.php">Experiences</a>
                <a href="./projects.php">Projects</a>
                <a href="./contacts.php">Contacts</a>
            </div>
        </div>
        <div class="right-side">
            <!-- Success/Error Messages -->
            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <!-- Add Category Form -->
            <form method="POST" class="mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Category</h5>
                    </div>
                    <div class="card-body">
                        <input type="text" name="category_name" class="form-control" required placeholder="Category Name">
                        <button type="submit" name="add_category" class="btn btn-primary mt-2">Add Category</button>
                    </div>
                </div>
            </form>

            <!-- Add Skill Form -->
            <form method="POST" class="mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Skill</h5>
                    </div>
                    <div class="card-body">
                        <select name="category_id" class="form-control mb-2" required>
                            <option value="">Select Category</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['category_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <input type="text" name="skill_name" class="form-control mb-2" required placeholder="Skill Name">
                        <input type="text" name="icon" class="form-control mb-2" required placeholder="Font Awesome Icon Class">
                        <button type="submit" name="add_skill" class="btn btn-success">Add Skill</button>
                    </div>
                </div>
            </form>

            <!-- Display Skills -->
            <div class="card">
                <div class="card-header">
                    <h5>My Skills</h5>
                </div>
                <div class="card-body">
                    <?php
                    $current_category = null;
                    foreach($skills as $skill):
                        if($skill['category_name'] !== $current_category):
                            if($current_category !== null) echo "</div>";
                            $current_category = $skill['category_name'];
                            echo "<h6 class='mt-3'>" . htmlspecialchars($current_category) . "</h6><div class='skill-group'>";
                        endif;
                    ?>
                        <div class="skill-item d-flex justify-content-between align-items-center mb-2">
                            <span><i class="<?= htmlspecialchars($skill['icon']) ?>"></i> <?= htmlspecialchars($skill['skill_name']) ?></span>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm" 
                                        onclick="openUpdateModal(
                                            '<?= $skill['id'] ?>', 
                                            '<?= $skill['category_id'] ?>', 
                                            '<?= htmlspecialchars($skill['skill_name']) ?>', 
                                            '<?= htmlspecialchars($skill['icon']) ?>'
                                        )">
                                    Update
                                </button>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="skill_id" value="<?= $skill['id'] ?>">
                                    <button type="submit" name="delete_skill" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    <?php 
                    endforeach;
                    if($current_category !== null) echo "</div>";
                    ?>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer container-fluid">
        <em class="text-white" style="font-size: 1.5rem;">Made with love by Toscani TENEKEU</em>
        <p class="text-white text-center">Feel free to use and customize it!</p>
    </footer>
    
    <!-- Add this modal HTML before the closing </body> tag -->
    <div class="modal fade" id="updateSkillModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Skill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="skill_id" id="updateSkillId">
                        <div class="mb-3">
                            <label>Category</label>
                            <select name="category_id" id="updateCategoryId" class="form-control" required>
                                <?php foreach($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['category_name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Skill Name</label>
                            <input type="text" name="skill_name" id="updateSkillName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Icon (Font Awesome class)</label>
                            <input type="text" name="icon" id="updateSkillIcon" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_skill" class="btn btn-primary">Update Skill</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
    function openUpdateModal(skillId, categoryId, skillName, icon) {
        document.getElementById('updateSkillId').value = skillId;
        document.getElementById('updateCategoryId').value = categoryId;
        document.getElementById('updateSkillName').value = skillName;
        document.getElementById('updateSkillIcon').value = icon;
        new bootstrap.Modal(document.getElementById('updateSkillModal')).show();
    }
    </script>

</body>
</html>
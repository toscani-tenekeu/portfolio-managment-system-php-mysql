<?php
    require '../../db/connection.php';
    require '../functions/auth_devices_compatibility_dashb.php'; 
    session_start();

    if(isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
        unset($_SESSION['error']);
    }

        if(isset($_SESSION['message'])) {
            echo "<script>alert('".$_SESSION['message']."');</script>"; 
            unset($_SESSION['message']);
        }

    

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        login();
    }

    function login() {
            global $pdo;
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT id, full_name, email, password FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if($user && password_verify($password, $user['password'])) {

                $_SESSION['user_found'] = "Welcome !";
                $_SESSION['user_full_name'] = $user['full_name'];
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['is_logged_in_manage_mode'] = true; 
                header('Location: ./main.php');                
            }
            else {
                $_SESSION['error'] = "User not found !";
            }
       
 
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 styles-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <title>Choose Your Path | Portfolio Manager</title>

    <style>
        body {
            background: linear-gradient(135deg, #00b4db, #0083b0);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
            padding: 2rem;
        }

        .choice-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        .choice-btn {
            display: block;
            width: 100%;
            padding: 1.5rem;
            margin: 1rem 0;
            border: 2px solid #0083b0;
            border-radius: 10px;
            background: white;
            color: #0083b0;
            text-decoration: none;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .choice-btn:hover {
            background: #0083b0;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .choice-btn i {
            margin-right: 10px;
        }

        .login-form {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 0 50px rgba(0,0,0,0.3);
            width: 90%;
            max-width: 400px;
            display: none;
        }

        .login-form.flex {
            display: block;
        }

        .login-form form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .login-form input {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }

        .login-form button {
            background: #0083b0;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .login-form button:hover {
            background: #006488;
        }

        #close {
            position: absolute;
            top: 15px;
            right: 15px;
            color: #666;
            text-decoration: none;
            font-size: 1.5rem;
        }

        #close:hover {
            color: #333;
        }

        .alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }
    </style>
</head>
<body>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="choice-container">
        <h1 class="mb-4">Welcome to Portfolio Manager</h1>
        <p class="text-muted mb-4">Choose how you'd like to proceed</p>
        
        <a href="./login.php" class="choice-btn">
            <i class="fas fa-eye"></i>
            View Your Portfolio
        </a>
        
        <a href="#" id="loginLink" class="choice-btn">
            <i class="fas fa-cog"></i>
            Manage Your Portfolio
        </a>
    </div>

    <div class="login-form">
        <a href="#" id="close">
            <i class="fas fa-times"></i>
        </a>
        <h3 class="text-center mb-4">Login to Dashboard</h3>
        <form action="" method="POST">
            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <button type="submit">
                <i class="fas fa-sign-in-alt"></i>
                Go to Dashboard
            </button>
        </form>
    </div>

    <script>
        const loginForm = document.querySelector('.login-form');
        const closeBtn = document.querySelector('#close');
        const loginLink = document.querySelector('#loginLink');

        // Show login form
        loginLink.addEventListener('click', (e) => {
            e.preventDefault();
            loginForm.classList.add('flex');
        });

        // Hide login form
        closeBtn.addEventListener('click', (e) => {
            e.preventDefault();
            loginForm.classList.remove('flex');
        });
    </script>
</body>
</html>
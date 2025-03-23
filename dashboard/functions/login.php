<?php
    session_start();
    require '../../db/connection.php';
    global $pdo;

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'] ? $_POST['email'] : "";
        $password = $_POST['password'] ? $_POST['password'] : "";

        $stmt = $pdo->prepare("SELECT id, email, full_name, password FROM users WHERE email = ?");
        $stmt->execute([$email]);

        $user = $stmt->fetch();

        if(password_verify($password, $user['password']) && $email = $user['email']) {
            $_SESSION['is_logged_in_view_mode'] = true;
            $_SESSION['user_full_name'] = $user['full_name'];
            $_SESSION['user_id'] = $user['id'];
            header('Location: ../../views/main.php');
        } else {
            $_SESSION['error'] = "Not Found Or Wrong Credentials !";
            header('Location: ../views/login.php');
        }
    }
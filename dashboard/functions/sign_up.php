<?php
    require '../../db/connection.php';

    try{
        global $pdo;

        $email = $_POST['email'];
        $full_name = $_POST['full_name'];
        $tel = $_POST['tel'];
        $age = $_POST['age'];
        $password = $_POST['password'];

        $encrypted_password = password_hash($password, PASSWORD_BCRYPT);
        echo $email." ".$full_name." ".$tel." ".$age." ".$password." ".$encrypted_password;

        $stmt = $pdo->prepare("INSERT INTO `users`(`email`, `full_name`, `tel`, `age`, `password`) VALUES (?, ?, ?, ?, ?)"); 
        $result = $stmt->execute([$email,$full_name,$tel,$age,$encrypted_password]);
        
        session_start();
        $_SESSION['message'] = "Profil created successfully!";
    
        Header('Location: ../views/choice.php');

        exit();
    } catch(Exception $e){
        die("Error: ".$e->getMessage());
    }
    
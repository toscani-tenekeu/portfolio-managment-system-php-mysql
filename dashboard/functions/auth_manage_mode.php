<?php
    session_start();
    if(isset($_SESSION['is_logged_in_manage_mode']) && $_SESSION['is_logged_in_manage_mode']) {
        // Do nothing
    } else {
        header('Location: ../views/choice.php');
        $_SESSION['error'] = "403 Forbidden Access!";
    }
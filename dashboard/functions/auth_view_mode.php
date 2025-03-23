<?php
    session_start();
    if(isset($_SESSION['is_logged_in_view_mode']) && $_SESSION['is_logged_in_view_mode']) {
        // Do nothing
    } else {
        header('Location: ../views/choice.php');
    }
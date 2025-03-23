<?php
session_start();
session_destroy();
header('Location: ../views/choice.php');
exit();
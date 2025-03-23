<?php

try {
    $dsn = "mysql:host=sql307.infinityfree.com;dbname=if0_38562644_portfolio_website_php_mysql";
    $username = "if0_38562644";
    $password = "password4321go";

    $pdo = new PDO($dsn, $username, $password);
} catch(Exception $e) {
    die("Error: ".$e->getMessage());
}

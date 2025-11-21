<?php

try {
    // Configuration settings
    $dbh = new PDO('mysql:host=localhost;dbname=airbnb;charset=utf8', 'root', '');
}catch (PDOException $e) {
    // Handle connection error
    die('Database connection failed: ' . $e->getMessage());
}


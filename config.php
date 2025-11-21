<?php
// Connexion à la base de données MySQL avec PDO
try {
    $dbh = new 	PDO( 'mysql:host=localhost;dbname=football;charset=utf8', 'root', 'L@elwifi2025');
}   catch (PDOException $e){
        die($e->getMessage());
}
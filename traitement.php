<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $sql = "INSERT INTO listings (name, description, price, host_name, picture_url)
            VALUES (:name, :description, :price, :host_name, :picture_url)";

    $stmt = $dbh->prepare($sql);

    $stmt->execute([
        ':name'         => $_POST['name'],
        ':description'  => $_POST['description'],
        ':price'        => $_POST['price'],
        ':host_name'    => $_POST['host_name'],
        ':picture_url'  => $_POST['picture_url']
    ]);

    header("Location: airbnb_place.php?ajout=ok");
    exit();
}
?>
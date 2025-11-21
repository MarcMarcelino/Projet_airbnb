<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un logement Airbnb</title>
    <link rel="stylesheet" href="airbnb.css">
</head>
<body>
    <h1>Ajouter un logement Airbnb</h1>

<form action="traitement.php" method="POST" enctype="multipart/form-data">

    <label>Nom : </label>
    <input type="text" name="nom" required><br>

    <label>Description : </label>
    <textarea name="description" required></textarea><br>

    <label>Prix (€) : </label>
    <input type="number" name="prix" required><br>

    <label>Propriétaire : </label>
    <input type="text" name="proprietaire" required><br>

    <label>URL de l'image :</label>
    <input type="url" name="image_url" placeholder="https://exemple.com/photo.jpg" required><br>


    <button type="submit">Ajouter</button>

</form>

    
</body>
</html>
<?php
require_once 'config.php';  

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
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

    <label>Image : </label>
    <input type="file" name="image" accept="image/*" required><br>

    <button type="submit">Ajouter</button>

</form>

</body>
</html>

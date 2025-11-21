<?php
require_once 'config.php';
$sth = $dbh->prepare("SELECT * FROM listings LIMIT 10");
$sth->execute();
$results = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <div class="p-6 bg-gray-100 min-h-screen">
    <h2 class="text-2xl font-bold mb-4">Locations disponibles</h2>

    <div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold mb-6">Locations Airbnb</h1>

    <div class="flex flex-wrap -mx-3">
        <?php foreach ($results as $row): ?>
            <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 px-3 mb-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <img class="w-full h-48 object-cover" src="<?= htmlspecialchars($row['picture_url'] ?? 'https://via.placeholder.com/300') ?>" alt="Image">

                    <div class="p-4">
                        <h2 class="font-bold text-lg mb-1"><?= htmlspecialchars($row['name']) ?></h2>
                        <p class="text-gray-600 text-sm mb-1">Hôte : <?= htmlspecialchars($row['host_name']) ?></p>
                        <p class="text-gray-600 text-sm mb-2">Quartier : <?= htmlspecialchars($row['neighbourhood_group_cleansed'] ?? 'N/A') ?></p>
                        <p class="font-semibold text-indigo-600"><?= htmlspecialchars($row['price']) ?> € / nuit</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
</body>
</html>

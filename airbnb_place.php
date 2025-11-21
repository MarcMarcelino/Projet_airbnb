
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
<?php
require_once 'config.php';
$triOptions = ['name' => 'Nom', 'neighbourhood_group_cleansed' => 'Ville', 'price' => 'Prix', 'host_name' => 'Propriétaire'];

$tri = isset($_GET['tri']) && array_key_exists($_GET['tri'], $triOptions)
        ? $_GET['tri']
        : 'name';
$dir = (isset($_GET['dir']) && strtolower($_GET['dir']) === 'desc') ? 'DESC' : 'ASC';
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;


$total = $dbh->query("SELECT COUNT(*) FROM listings")->fetchColumn();
$totalPages = ceil($total / $limit);

if ($tri === 'price') {
    $orderExpr = "CAST(price AS UNSIGNED) $dir";
} else {
    $orderExpr = "`$tri` $dir";
}

$sql = "SELECT * FROM listings ORDER BY $orderExpr LIMIT :limit OFFSET :offset";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

$toggleDir = ($dir === 'ASC') ? 'desc' : 'asc';
?>
<div class="container mx-auto p-6">
  <h1 class="text-3xl font-bold mb-6">Locations Airbnb</h1>
  <div class="flex justify-between items-center mb-4">
    <form method="get" class="mb-4 flex items-center gap-3">
        <label class="font-medium">Trier par :</label>
        <select name="tri" onchange="this.form.submit()" class="px-3 py-2 border rounded">
            <?php foreach ($triOptions as $col => $label): ?>
                <option value="<?= htmlspecialchars($col) ?>" <?= $col === $tri ? 'selected' : '' ?>>
                    <?= htmlspecialchars($label) ?>
                </option>
            <?php endforeach; ?>
        </select>


        <a href="?tri=<?= urlencode($tri) ?>&dir=<?= $toggleDir ?>&page=<?= $page ?>"
            class="ml-4 px-3 py-2 border rounded bg-white">
            Trier <?= $dir === 'ASC' ? '↑' : '↓' ?> (basculer)
        </a>
    </form>
    <button class="px-3 py-2 border rounded bg-green-500 text-white"><a href="ajout_airbnb.php">Ajouter un AIRBNB</a></button>
  </div>

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
<div style="margin-top:20px; text-align:center;">
    Affichage de <?= min($offset + 1, $total) ?> à <?= min($offset + $limit, $total) ?> sur <?= $total ?> logements.
</div>
<div style="margin-top:20px; text-align:center;">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>&tri=<?= $tri ?>">Précédent</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?= $i ?>&tri=<?= $tri ?>"
           style="font-weight:bold; color:<?= $i==$page?'red':'black' ?>;">
            <?= $i ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page + 1 ?>&tri=<?= $tri ?>">Suivant</a>
    <?php endif; ?>
</div>
</body>
</html>

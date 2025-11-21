<?php

// ajout de la pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;


$sort = "nom";
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}
$order = "desc";
if (isset($_GET['order'])) {
    $order = $_GET['order'];
}
?>
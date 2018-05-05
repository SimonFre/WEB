<?php
require_once 'header.php';
require_once './include/dbh.php';

if (!isset($nom)) {
  $nom = mysqli_real_escape_string($conn, $_POST['nom']);
}
$categorie = mysqli_real_escape_string($conn, $_POST['categorie']);
$region = mysqli_real_escape_string($conn, $_POST['region']);
$prix_min = $_POST['prix_min'];
$prix_max = $_POST['prix_max'];

$sql = "SELECT * FROM publication WHERE `title` LIKE '%".$nom."%' AND `categorie` LIKE '%".$categorie."%'
AND `region` LIKE '%".$region."%'";

if (isset($_GET['order']) && !empty($_GET['order'])) {
  if ($_GET['order'] == "prix") {
    $sql .= "ORDER BY `prix` DESC";
  }
  else {
    $sql .= "ORDER BY `id` DESC";
  }
}
else {
  $sql .= "ORDER BY `id` DESC";
}

include './display.php';
?>

<?php
$nom = $_POST['nom'];
$categorie = $_POST['categorie'];
$region = $_POST['region'];
$prix_min = $_POST['prix_min'];
$prix_max = $_POST['prix_max'];

$sql = "SELECT * FROM publication WHERE `title` LIKE '%".$nom."%'";

include '../display.php';
?>

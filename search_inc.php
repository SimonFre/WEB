<!-- Resultat de la recherche -->
<?php
require_once 'header.php';
require_once './include/dbh.php';

if (isset($_POST['search'])) {
  setcookie("nom", $_POST['nom'], time() + 60 * 60 * 24);
  $nom = $_POST['nom'];
  setcookie("categorie", $_POST['categorie'], time() + 60 * 60 * 24);
  $categorie = $_POST['categorie'];
  setcookie("region", $_POST['region'], time() + 60 * 60 * 24);
  $region = $_POST['region'];
} else {
  if (isset($_COOKIE['nom'])) {
    $nom = $_COOKIE['nom'];
  } else {
    $nom = "";
  }
  if (isset($_COOKIE['categorie'])) {
    $categorie = $_COOKIE['categorie'];
  } else {
    $categorie = "";
  }
  if (isset($_COOKIE['region'])) {
    $region = $_COOKIE['region'];
  } else {
    $region = "";
  }
}
/*
$prix_min = $_POST['prix_min'];
$prix_max = $_POST['prix_max'];
*/

$sql = "SELECT * FROM publication WHERE `title` LIKE '%".$nom."%' AND `categorie` LIKE '%".$categorie."%'
AND `region` LIKE '%".$region."%' ";

if (isset($_GET['order']) && !empty($_GET['order'])) {
  if ($_GET['order'] == "prix") {
    $sql .= "ORDER BY `prix` DESC ";
  }
  else {
    $sql .= "ORDER BY `id` DESC ";
  }
}
else {
  $sql .= "ORDER BY `id` DESC ";
}

include './display.php'; // Affichage
?>

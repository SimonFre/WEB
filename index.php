<!-- Page d'accueil du site -->
<?php
require_once('header.php');

?>

<?php
if (isset($_GET['order']) && !empty($_GET['order'])) {
  if ($_GET['order'] == "prix") {
    $sql = "SELECT * FROM publication ORDER BY `prix` DESC ";
  }
  else {
    $sql = "SELECT * FROM publication ORDER BY `id` DESC ";
  }
}
else {
  $sql = "SELECT * FROM publication ORDER BY `id` DESC ";
}

include './display.php'; // Affichage
?>

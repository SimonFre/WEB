<?php
session_start();

require './include/dbh.php';

$id = $_GET['edit'];

$sql = "SELECT * FROM publication WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Si l'id de l'annonceur == l'id de la session
if ($row['user_id'] == $_SESSION['id']) {
  $img1 = $row['file1'];

  if (!empty($row["file1"])) {
    echo "Pas vide!";
    echo '<img src="./data/'.$row["file1"].'" alt="" style="height:150px">';
  } else {
    echo "Vide!";
    echo '<img src="./data/no_image.jpg" alt="" style="height:150px">';
  }

  $title = $row['title'];
  $despt = $row['despt'];
  $categorie = $row['categorie'];
  $region = $row['region'];
  $prix = $row['prix'];
  $date = $row['date'];

}
else {
  // Sinon
  header("Location: ./index.php");
  exit();
}
?>

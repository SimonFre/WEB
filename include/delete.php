<!-- Suppression d'un annonce -->
<?php
session_start();

require 'dbh.php';

$id = $_GET['delete'];

$sql = "SELECT * FROM publication WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Si l'id de l'annonceur == l'id de la session
if ($row['user_id'] == $_SESSION['id']) {
  unlink("../data/".$row['file1'].""); // Supprimer le fichier local de l'image
  unlink("../data/".$row['file2']."");
  unlink("../data/".$row['file3']."");

  $sql = "DELETE FROM publication WHERE id='$id'"; // Supprimer la ligne dans la table
  $result = mysqli_query($conn, $sql);

  header("Location: ../account.php");
  exit();
}
// Sinon
header("Location: ../index.php");
exit();
?>

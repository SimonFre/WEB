<?php
session_start();

require 'dbh.php';

$id = $_GET['delete'];

$sql = "SELECT * FROM publication WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$img = $row['file1'];
echo $img;
unlink("../data/".$row['file1'].""); // Supprimer le fichier local de l'image

$sql = "DELETE FROM publication WHERE id='$id'"; // Supprimer la ligne dans la table
$result = mysqli_query($conn, $sql);

header("Location: ../account.php?tab=mes_annonces");
exit();
?>

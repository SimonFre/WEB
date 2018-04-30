<?php
require_once('header.php');

require './include/dbh.php';

$annonce = $_GET['annonce'];

$sql = "SELECT * FROM publication WHERE id='$annonce'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$date = $row['date'];
echo $date;
$despt = $row['despt'];
echo $despt;

require_once('footer.php');
?>

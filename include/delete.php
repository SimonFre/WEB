<<?php
require 'dbh.php';

$id = $_GET['delete'];

$sql = "DELETE FROM publication WHERE id='$id'";
$result = mysqli_query($conn, $sql);

header("Location: ../account.php");
exit();
?>

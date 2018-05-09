<!-- Suppression d'un compte utilisateur -->
<?php
session_start();
require 'dbh.php';

$sql = "DELETE FROM publication WHERE user_id='".$_SESSION['id']."'";
mysqli_query($conn, $sql);
$sql = "DELETE FROM users WHERE id='".$_SESSION['id']."'";
mysqli_query($conn, $sql);

require 'logout_inc.php';

?>

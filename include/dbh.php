<!-- Connexion à la base de donnée -->
<?php

$dbserver = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "web";

$conn = mysqli_connect($dbserver, $dbusername, $dbpassword, $dbname);

?>

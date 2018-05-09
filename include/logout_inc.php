<!-- Déconnexion de l'utilisateur -->
<?php
session_start();
session_unset();
session_destroy();
header("Location: ../index.php");
exit();

?>

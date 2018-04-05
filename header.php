<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Titre du site</title>
    <link rel="stylesheet" href="./css/main.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>

<body>
    <div class="topnav">
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="search.php">Rechercher un annonce</a></li>
        <li><a href="depo.php">Déposer une annonce</a></li>
      </ul>
      <?php
      if (isset($_SESSION['email'])) {
        echo '<ul>
                <li style="float:right"><a href="./include/logout_inc.php">Se déconnecter</a></li>
                <li style="float:right"><a href="./account.php">Mon compte</a></li>
              </ul>';
      } else {
        echo '<ul>
                <li style="float:right"><a href="signin.php">Connexion</a></li>
                <li style="float:right"><a href="signup.php">Inscription</a></li>
              </ul>';
      }
      ?>
    </div>

    <div class="content">

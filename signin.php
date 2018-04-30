<?php
require_once('header.php');
if (isset($_SESSION['error'])) {
  echo $_SESSION['error'];
}
?>

<link rel="stylesheet" href="./css/sign.css" />

<div class="form">

  <form class="login-form" action="./include/signin_inc.php" method="post">
    <h2>Connexion</h2>
<?php if (isset($_GET['signup'])) {
        $signup = $_GET['signup'];
        if ($signup == 'success') {
          echo '<div class="alert alert-success">
                  <strong>Votre compte a été crée.</strong>
                </div>';
        }
      }
      if (isset($_GET['login'])) {
        $signup = $_GET['login'];
        if ($signup == 'error') {
          echo '<div class="alert alert-danger">
                  <strong>Mauvais Email ou Mot de passe</strong>
                </div>';
        }
      } ?>
    <input type="text" name="email" placeholder="Email" required autofocus/>
    <input type="password" name="pwd" placeholder="Mot de passe" required/>
    <button type="submit" name="submit">Se connecter</button>
  </form>
</div>


<?php
require_once('footer.php');
?>

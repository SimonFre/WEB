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
    <input type="text" name="email" placeholder="Email" required autofocus/>
    <input type="password" name="pwd" placeholder="Mot de passe" required/>
    <button type="submit" name="submit">Se connecter</button>
  </form>
</div>


<?php
require_once('footer.php');
?>

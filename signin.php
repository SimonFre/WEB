<?php
require_once('header.php');
if (isset($_SESSION['error'])) {
  echo $_SESSION['error'];
}
?>

<link rel="stylesheet" href="./css/sign.css" />

<div class="form">

  <form class="login-form" action="./include/signin_inc.php" method="post">
    <input type="text" name="email" placeholder="Email" required/>
    <input type="password" name="pwd" placeholder="Mot de passe" required/>
    <button type="submit" name="submit">Se connecter</button>
  </form>
</div>


<?php
require_once('footer.php');
?>

<?php
require_once('header.php');
session_start();
?>

<link rel="stylesheet" href="./css/signup.css" />

<div class="form">

  <form class="login-form">
    <input type="text" placeholder="Email" required/>
    <input type="password" placeholder="Mot de passe" required/>
    <button>Se connecter</button>
  </form>
</div>


<?php
require_once('footer.php');
?>

<?php
require_once('header.php');
if (isset($_SESSION['error'])) {
  echo $_SESSION['error'];
}
?>

<link rel="stylesheet" href="./css/sign.css" />
  <div class="form">

    <form class="login-form" action="./include/signup_inc.php" method="post">
      <input type="text" name="nom" placeholder="Nom" required/>
      <input type="text" name="prenom" placeholder="Prénom" required/>
      <input type="text" name="adresse" placeholder="Adresse"/>
      <input type="text" name="ville" placeholder="Ville" required/>
      <input type="text" name="email" placeholder="Email" required/>
      <input type="text" name="tel" placeholder="Téléphone"/>
      <input type="password" name="pwd1" placeholder="Mot de passe" required/>
      <input type="password" name="pwd2" placeholder="Confirmation" required/>
      <button type="submit" name="submit">S'inscrire</button>
    </form>
  </div>


<?php
require_once('footer.php');
?>

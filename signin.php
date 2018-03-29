<?php
require_once('header.php');
?>

<link rel="stylesheet" href="./css/signup.css" />
  <div class="form">

    <form class="login-form">
      <input type="text" placeholder="Nom" required/>
      <input type="text" placeholder="Prénom" required/>
      <input type="text" placeholder="Adresse"/>
      <input type="text" placeholder="Ville" required/>
      <input type="text" placeholder="Email" required/>
      <input type="text" placeholder="Téléphone"/>
      <input type="password" placeholder="Mot de passe" required/>
      <input type="password" placeholder="Confirmation" required/>
      <button>S'inscrire</button>
    </form>
  </div>


<?php
require_once('footer.php');
?>

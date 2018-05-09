<!-- Page d'inscription au site -->
<?php
require_once('header.php');

require './include/list_inc.php';
?>
<link rel="stylesheet" href="./css/sign.css" />

<article>
  <div class="container">
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <h1>Inscription</h1>
<!-- Error affichage -->
<?php if (isset($_GET['signup'])) {
        $signup = $_GET['signup'];
        if ($signup == 'empty') {
          echo '<div class="alert alert-danger">
                  <strong>Certains champs n\'ont pas été remplis.</strong>
                </div>';
        } if ($signup == 'invalid') {
          echo '<div class="alert alert-danger">
                  <strong>Certains caractères ne sont pas autorisés.</strong>
                </div>';
        } if ($signup == 'wrongemail') {
          echo '<div class="alert alert-danger">
                  <strong>Email invalide.</strong>
                </div>';
        } if ($signup == 'email') {
          echo '<div class="alert alert-danger">
                  <strong>Email déjà utilisé.</strong>
                </div>';
        }
        if ($signup == 'pwd') {
          echo '<div class="alert alert-danger">
            <strong>Les mots de passe ne correspondent pas.</strong>
          </div>';
        }
      } ?>

        <form action="./include/signup_inc.php" method="post">
          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control" name="nom" placeholder="Nom *" required>
          </div>
          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control" name="prenom" placeholder="Prénom *" required>
          </div>
          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-road"></i></span>
            <input type="text" class="form-control" name="adresse" placeholder="Adresse">
          </div>
          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-building"></i></span>
            <input type="text" class="form-control" name="ville" placeholder="Ville *" required>
          </div>

          <div class="form-group">
<?php echo '<select class="form-control" name="region" required>
              <option value="" selected="selected" disabled>Région : *</option>';
              foreach($Regions as $region) {
                echo '<option value="'.$region.'">'.$region.'</option>';
              }
      echo '</select>'; ?>
          </div>
          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-at"></i></span>
            <input type="text" class="form-control" name="email" placeholder="Email *" required>
          </div>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
            <input type="text" class="form-control" name="tel" placeholder="Téléphone">
          </div>

          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-key"></i></span>
            <input type="password" class="form-control" name="pwd1" placeholder="Mot de passe *" required>
          </div>

          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-key"></i></span>
            <input type="password" class="form-control" name="pwd2" placeholder="Confirmation *" required>
          </div>

          <button class="btn btn-success btn-block" type="submit" name="submit">S'inscrire</button>
        </form>
      </div>
      <div class="col-sm-4"></div>
    </div>
  </div>
</article>


<?php
require_once('footer.php');
?>

<?php
require_once('header.php');
?>

<?php
if (isset($_SESSION['email'])) {
  echo '<link rel="stylesheet" href="./css/depo.css" />
          <div class="form">
            <form class="login-form" action="./include/depo_inc.php" method="post" enctype="multipart/form-data">
              <h2>Déposer une annonce</h2>
              <div class="element_file">
              <input name="file" type="file" />  <!-- multiple="" -->
              </div>
              <div class="title">
                <input type="text" name="titre" placeholder="Titre de l\'annonce" required/><br />
              </div>
              <textarea name="subject" placeholder="Description"></textarea><br />
              <div class="price">
                <input type="text" name="prix" maxlength="8" placeholder="Prix" required />
                <i class="fa fa-eur" aria-hidden="true"></i>
              </div><br>
              <button type="submit" name="publier">Publier</button>
            </form>
          </div>';
} else {
  echo '<h2>Vous devez être connecté.</h2>';
}
?>

<?php
require_once('footer.php');
?>

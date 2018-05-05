<?php
require_once('header.php');
?>

<link rel="stylesheet" href="./css/sign.css" />
<?php
require './include/list_inc.php';

if (isset($_SESSION['email'])) { ?>

  <article>
    <div class="container">
      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
          <h1>Déposer une annonce</h1>
  <?php if (isset($_GET['error'])) {
          $error = $_GET['error'];
          if ($error == 'heavy') {
            echo '<div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p>Image trop lourde.</p>
                  </div>';
          } if ($error == 'error') {
            echo '<div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p>Une erreur est survenu.</p>
                  </div>';
          } if ($error == 'format') {
            echo '<div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p>Format du fichier non supporté.</p>
                  </div>';
          } if ($error == 'prix') {
            echo '<div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <p>Prix invalide.</p>
                  </div>';
          }
        } ?>
        </div>
      </div>
      <form action="./include/depo_inc.php" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-sm-3"></div>
          <div class="col-sm-2">
            <div class="input-group">
              <input type="file" class="form-control" name="file1" />
            </div>
          </div>
          <!--
          <div class="col-sm-2">
            <div class="input-group">
              <span class="input-group-addon"></span>
              <input type="file" class="form-control" name="file2" />
            </div>
          </div>
          <div class="col-sm-2">
            <div class="input-group">
              <span class="input-group-addon"></span>
              <input type="file" class="form-control" name="file3" />
            </div>
          </div>
        -->
          <div class="col-sm-3"></div>
        </div>
        <div class="row">
          <div class="col-sm-3"></div>
          <div class="col-sm-6">
            <div class="input-group">
              <span class="input-group-addon"><i class=""></i></span>
              <input type="text" class="form-control" name="titre" placeholder="Titre de l'annonce *" required/>
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class=""></i></span>
              <textarea name="subject" class="form-control" placeholder="Description" rows="5"></textarea><br />
            </div>
            <div class="form-group">
              <select class="form-control" name="categorie" required>
                <option selected disabled> Catégorie : *</option>
                <optgroup label="Véhicule"></option>
    <?php       foreach($Vehicules as $vehicule) {
                  echo '<option value="'.$vehicule.'">'.$vehicule.'</option>';
                } ?>
                </optgroup>
                <optgroup label="Multimédia"></option>
    <?php       foreach($Multimedia as $multimedia) {
                  echo '<option value="'.$multimedia.'">'.$multimedia.'</option>';
                } ?>
                </optgroup>

                <optgroup label="Maison"></option>
    <?php       foreach($Maison as $maison) {
                  echo '<option value="'.$maison.'">'.$maison.'</option>';
                } ?>
                </optgroup>

                <optgroup label="Loisirs"></option>
    <?php       foreach($Loisirs as $loisirs) {
                  echo '<option value="'.$loisirs.'">'.$loisirs.'</option>';
                } ?>
                </optgroup>

                <optgroup label="Matériel professionnel"></option>
    <?php       foreach($Materiel as $materiel) {
                  echo '<option value="'.$materiel.'">'.$materiel.'</option>';
                } ?>
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <select class="form-control" name="region" required>
                <option selected disabled>Région :</option>
    <?php       foreach($Regions as $region) {
                  echo '<option value="'.$region.'">'.$region.'</option>';
                } ?>
              </select>
            </div>

            <div class="input-group">
              <input type="text" class="form-control" name="prix" placeholder="Prix" maxlength="8" required />
              <span class="input-group-addon"><i class="glyphicon glyphicon-eur"></i></span>
            </div>

            <button class="btn btn-success btn-block" type="submit" name="publier">Déposer l'annonce</button>
          </div>
          <div class="col-sm-3"></div>
        </div>
      </form>
  </article>

<?php
} else {
  echo '<div class="alert alert-danger">
          <p>Vous devez être connecté !</p>
        </div>';
}
?>

<?php
require_once('footer.php');
?>

<!-- Page d'édition d'annonces sur base de 'depo.php' -->
<?php
require_once('header.php');
require './include/dbh.php';
?>

<link rel="stylesheet" href="./css/sign.css" />
<?php
require './include/list_inc.php';

if (isset($_GET['edit']) && !empty($_GET['edit'])) {
  $id = $_GET['edit'];
  $sql = "SELECT * FROM publication WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  // Si l'id de l'annonceur == l'id de la session
  if (!empty($_SESSION['id']) && $row['user_id'] == $_SESSION['id']) {
    $file1 = $row['file1'];
    $title = $row['title'];
    $despt = $row['despt'];
    $categorie = $row['categorie'];
    $region = $row['region'];
    $prix = $row['prix'];
    $date = $row['date'];
?>
  <article>
    <div class="container">
      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
          <h1>Modifier une annonce</h1>
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
      <form action="./include/depo_inc.php?edit=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-sm-3"></div>
          <div class="col-sm-2">
            <div class="input-group">
              <input type="file" class="form-control" name="file1"/>
            </div>
          </div>
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
          <div class="col-sm-3"></div>
        </div>
        <div class="row">
          <div class="col-sm-3"></div>
          <div class="col-sm-6">
            <div class="input-group">
              <span class="input-group-addon"><i class=""></i></span>
              <input type="text" class="form-control" name="titre" placeholder="Titre de l'annonce" <?php echo "value='".$title."'"; ?> required/>
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class=""></i></span>
              <textarea name="subject" class="form-control" placeholder="Description" <?php echo "value='".$despt."'"; ?> rows="5"><?php echo $despt; ?></textarea><br />
            </div>
            <div class="form-group">
              <select class="form-control" name="categorie" required>
                <option disabled> Catégorie :</option>
                <option selected><?php echo $categorie; ?></option>
                <optgroup label="Véhicule"></optgroup>
    <?php       foreach($Vehicules as $vehicule) {
                  echo '<option value="'.$vehicule.'">'.$vehicule.'</option>';
                } ?>
                </optgroup>
                <optgroup label="Multimédia"></optgroup>
    <?php       foreach($Multimedia as $multimedia) {
                  echo '<option value="'.$multimedia.'">'.$multimedia.'</option>';
                } ?>
                </optgroup>

                <optgroup label="Maison"></optgroup>
    <?php       foreach($Maison as $maison) {
                  echo '<option value="'.$maison.'">'.$maison.'</option>';
                } ?>
                </optgroup>

                <optgroup label="Loisirs"></optgroup>
    <?php       foreach($Loisirs as $loisirs) {
                  echo '<option value="'.$loisirs.'">'.$loisirs.'</option>';
                } ?>
                </optgroup>

                <optgroup label="Matériel professionnel"></optgroup>
    <?php       foreach($Materiel as $materiel) {
                  echo '<option value="'.$materiel.'">'.$materiel.'</option>';
                } ?>
                </optgroup>
              </select>
            </div>
            <div class="form-group">
              <select class="form-control" name="region" required>
                <option disabled>Région :</option>
    <?php       foreach($Regions as $reg) {
                  if ($reg == $region) {
                    echo '<option value="'.$reg.'"selected>'.$reg.'</option>';
                  } else {
                    echo '<option value="'.$reg.'">'.$reg.'</option>';
                  }
                } ?>
              </select>
            </div>

            <div class="input-group">
              <input type="text" class="form-control" name="prix" placeholder="Prix" <?php echo "value='".$prix."'"; ?> maxlength="8" required />
              <span class="input-group-addon"><i class="fas fa-euro-sign"></i></span>
            </div>

            <button class="btn btn-success btn-block" type="submit" name="modifier">Modifier l'annonce</button>
          </div>
          <div class="col-sm-3"></div>
        </div>
      </form>
    </div>
  </article>

<?php
  } else {
    header("Location: ./index.php");
    exit();
  }
} else {
  header("Location: ./index.php");
  exit();
}
?>

<?php
require_once('footer.php');
?>

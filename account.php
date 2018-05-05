<?php
require_once('header.php');
?>
<?php
require './include/dbh.php';
require './include/list_inc.php';

$user_id = $_SESSION['id'];
?>

<link rel="stylesheet" href="./css/account.css" />

<article>
  <div class="container">
    <ul class="nav nav-tabs">
<?php
// Si tab existe et qu'il est différent du vide
if (isset($_GET['tab']) && !empty($_GET['tab'])) {
  $tab = $_GET['tab'];
  // Si tab == account -> "mon compte" = active
  if ($tab == "account") { ?>
      <li><a data-toggle="tab" href="#annonce">Mes annonces</a></li>
      <li class="active"><a data-toggle="tab" href="#account">Mon compte</a></li>
    </ul>
    <?php
  // Sinon tab != account donc "mes annonces" = active
  } else { ?>
      <li class="active"><a data-toggle="tab" href="#annonce">Mes annonces</a></li>
      <li><a data-toggle="tab" href="#account">Mon compte</a></li>
    </ul>
<?php
  }
// Sinon tab n'est pas défini donc "mes annonces" = active
} else { ?>
      <li class="active"><a data-toggle="tab" href="#annonce">Mes annonces</a></li>
      <li><a data-toggle="tab" href="#account">Mon compte</a></li>
    </ul>
<?php
} ?>

    <div class="tab-content">
<?php
    // Si tab == "account" alors annonce n'est pas active
    if (isset($tab) && $tab == "account") {
      echo '<div id="annonce" class="tab-pane fade">';
    } else {
      echo '<div id="annonce" class="tab-pane fade in active">';
    } ?>

    <!-- inserez ici Annonce-->
<?php
  $sql = "SELECT * FROM publication WHERE user_id='$user_id'";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  if ($resultCheck >= 1) { ?>
    <div class="row">
<?php
    while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="thumbnail" style="height:280px; width: 100%; overflow:hidden; text-overflow:ellipsis;">
<?php  echo '<a href="./edit.php?edit='.$row['id'].'">'; ?>
              <span class="glyphicon glyphicon-edit" style="float: left; font-size: 18px;"></span>
            </a>
<?php  echo '<a href="./include/delete.php?delete='.$row['id'].'">'; ?>
              <span class="glyphicon glyphicon-remove" style="color:red; float:right; font-size: 18px;"></span>
            </a>

<?php echo '<a href="./annonce?annonce='.$row['id'].'">'; ?>
      <?php if (!empty($row["file1"])) {
        echo '<img src="./data/'.$row["file1"].'" alt="" style="height:150px">';
            } else { ?>
              <img src="./data/no_image.jpg" alt="" style="height:150px">
      <?php } ?>

            <div class="caption">
  <?php echo "<h4>".$row['title']."</h4>";
        echo "<p>".$row['despt']."</p>"; ?>
            </div>
          </a>
        </div>
      </div>
<?php
    } ?>
    </div>
<?php
  } ?>

  </div>
<?php // Si tab == "account" alors account est active
      if (isset($tab) && $tab == "account") {
        echo '<div id="account" class="tab-pane fade in active">';
      } else {
        echo '<div id="account" class="tab-pane fade">';
      } ?>
        <!-- inserez ici Settings-->
<?php   if (isset($_GET['error']) && !empty($_GET['error'])) {
          $error = $_GET['error'];
          if ($error == 'empty') {
            echo '<div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Certains champs n\'ont pas été remplis.</strong>
                  </div>';
          } if ($error == 'invalid') {
            echo '<div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Certains caractères ne sont pas autorisés.</strong>
                  </div>';
          } if ($error == 'wrongemail') {
            echo '<div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Email invalide.</strong>
                  </div>';
          } if ($error == 'bad_pass') {
            echo '<div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>L\'ancien mot de passe ne correspond pas.</strong>
                  </div>';
          } if ($error == 'bad_conf') {
            echo '<div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Les nouveaux mot de passe ne correspondent pas.</strong>
                  </div>';
          } if ($error == 'success') {
            echo '<div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Vos modifications ont été appliquées.</strong>
                  </div>';
          }
        }
        if (!isset($_POST['modif'])) { ?>
          <form action="account.php?tab=account" method="post">
            <div class="form-group">
              <label for="prenom">Votre prénom</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['prenom'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label for="name">Votre nom</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['nom'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label for="adresse">Votre adresse</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['adresse'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label for="ville">Votre ville</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['ville'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label for="region">Votre region</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['region'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label for="email">Votre email</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['email'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label for="tel">Votre téléphone</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['tel'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label for="mdp">Votre mot de passe</label>
              <input class="form-control" type="text" placeholder="********" disabled>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4 col-xs-6"></div>
            <div class="col-sm-4 col-xs-6">
              <button class="btn btn-success btn-block" type="submit" name="modif">Modifier</button>
            </div>
          </form>
<?php   }
        elseif (isset($_POST['modif'])) { ?>
          <form action="./include/account_inc.php" method="post">
            <div class="form-group">
              <label for="prenom">Votre prénom</label>
  <?php echo '<input class="form-control" type="text" name="prenom" value="'.$_SESSION['prenom'].'" required>'; ?>
            </div>
            <div class="form-group">
              <label for="nom">Votre nom</label>
  <?php echo '<input class="form-control" type="text" name="nom" value="'.$_SESSION['nom'].'" required>'; ?>
            </div>
            <div class="form-group">
              <label for="adresse">Votre adresse</label>
  <?php echo '<input class="form-control" type="text" name="adresse" value="'.$_SESSION['adresse'].'">'; ?>
            </div>
            <div class="form-group">
              <label for="ville">Votre ville</label>
  <?php echo '<input class="form-control" type="text" name="ville" value="'.$_SESSION['ville'].'" required>'; ?>
            </div>
            <div class="form-group">
              <label for="region">Votre region</label>
              <select class="form-control" name="region" required>
  <?php         foreach($Regions as $region) {
                  if ($region == $_SESSION['region']) {
                    echo '<option value="'.$region.'" selected>'.$region.'</option>';
                  } else {
                    echo '<option value="'.$region.'">'.$region.'</option>';
                  }
                } ?>
              </select>
            </div>

            <div class="form-group">
              <label for="email">Votre email</label>
  <?php echo '<input class="form-control" type="text" name="email" value="'.$_SESSION['email'].'" required>'; ?>
            </div>
            <div class="form-group">
              <label for="tel">Votre téléphone</label>
  <?php echo '<input class="form-control" type="text" name="tel" value="'.$_SESSION['tel'].'">'; ?>
            </div>

            <!-- Changer de mot de passe -->
            <div class="form-group">
              <label for="mdp">Votre mot de passe actuel</label>
              <input class="form-control" type="password" name="old_pass" placeholder="********">
            </div>
            <div class="form-group">
              <label for="mdp">Votre nouveau mot de passe</label>
              <input class="form-control" type="password" name="new_pass" placeholder="********">
            </div>
            <div class="form-group">
              <label for="mdp">Confirmer le mot de passe</label>
              <input class="form-control" type="password" name="conf_pass" placeholder="********">
            </div>

            <div class="col-sm-4 "></div>
            <div class="col-sm-4 col-xs-6">
              <button class="btn btn-danger btn-block" type="reset" name="reset">Annuler</button> <!-- passer en submit ?? -->
            </div>
            <div class="col-sm-4 col-xs-6">
              <button class="btn btn-success btn-block" type="submit" name="enreg">Enregistrer</button>
            </div>

          </form>
<?php   } ?>
      </div>
    </div>
  </div>
</article>


<?php
require_once('footer.php');
?>

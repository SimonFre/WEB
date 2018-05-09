<!-- Page de gestion d'un compte utilisateur -->
<?php
require_once('header.php');

require './include/dbh.php';
require './include/list_inc.php';

if (!empty($_SESSION['id'])) {
  $user_id = $_SESSION['id'];
} else {
  header("Location: ./index.php");
}
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
  $sql = "SELECT * FROM publication WHERE user_id='$user_id' ";

  // Pagination
  $ParPage = 6;
  $result = mysqli_query($conn, $sql);
  $NbPages = ceil(mysqli_num_rows($result) / $ParPage);

  if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $NbPages) {
    $page = intval($_GET['page']);
  } else {
    $page = 1;
  }
  $depart = ($page - 1) * $ParPage;

  $sql .= "LIMIT ".$depart.",".$ParPage;

  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  if ($resultCheck >= 1) { ?>
    <div class="row">
<?php
    while($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col-xs-12 col-sm-6 col-md-4">
          <div class="thumbnail" style="height:280px; width: 100%; overflow:hidden; text-overflow:ellipsis;">
<?php  echo '<a href="./edit.php?edit='.$row['id'].'">'; ?>
              <span class="far fa-edit" style="float: left; font-size: 18px;"></span>
            </a>
<?php  echo '<a href="./include/delete.php?delete='.$row['id'].'">'; ?>
              <span class="far fa-trash-alt" style="color:red; float:right; font-size: 18px;"></span>
            </a>

<?php echo '<a href="./annonce?annonce='.$row['id'].'">'; ?>
      <?php if (!($row["file1"] == "NULL")) {
        echo '<img src="./data/'.$row["file1"].'" alt="" style="height:150px">';
            } else { ?>
              <img src="./data/no_image.jpg" alt="" style="height:150px">
      <?php } ?>

            <div class="caption">
  <?php echo "<h4>".$row['title']."</h4>";
               if (!empty($row['despt'])) {
                echo "<p>".$row['despt']."</p>";
              } else {
                echo "<h5>Aucune description n'a été émise.</h5>";
              } ?>
            </div>
          </a>
        </div>
      </div>
<?php
    } ?>
    </div>
    <!-- Affichage pagination -->
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <ul class="pagination">
        <?php
        if ($NbPages > 1) {
          $min = max($page - 2, 1); // Pas de page < 1
          $max = min($page + 2, $NbPages); // pas de page > $NbPages
          for ($i= $min; $i <= $max; $i++) {
            if (isset($_GET['order']) && !empty($_GET['order'])) {
              if ($_GET['order'] == "prix") {
                if ($page == $i) {
                  echo "<li class='disabled'><a href='?order=prix&page=".$i."'>".$i."</a></li>";
                } else {
                  echo "<li><a href='?order=prix&page=".$i."'>".$i."</a></li>";
                }
              }
              else {
                if ($page == $i) {
                  echo "<li class='disabled'><a href='?order=date&page=".$i."'>".$i."</a></li>";
                } else {
                  echo "<li><a href='?order=date&page=".$i."'>".$i."</a></li>";
                }
              }
            }
            else {
              if ($page == $i) {
                echo "<li class='disabled'><a href='?page=".$i."'>".$i."</a></li>";
              } else {
                echo "<li><a href='?page=".$i."'>".$i."</a></li>";
              }
            }
          }
        }
        ?>
      </ul>
    </div>
    <div class="col-md-4"></div>
<?php
} else {
  echo "<h5>Vous n'avez aucune annonces.</h>";
}?>

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
              <label>Votre prénom</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['prenom'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label>Votre nom</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['nom'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label>Votre adresse</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['adresse'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label>Votre ville</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['ville'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label>Votre region</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['region'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label>Votre email</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['email'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label>Votre téléphone</label>
  <?php echo '<input class="form-control" type="text" placeholder="'.$_SESSION['tel'].'" disabled>'; ?>
            </div>
            <div class="form-group">
              <label>Votre mot de passe</label>
              <input class="form-control" type="text" placeholder="********" disabled>
            </div>
            <div class="col-sm-4 col-xs-4">
              <button class="btn btn-danger btn-block" formaction="./include/delete_user.php" type="submit" name="delete">Supprimer le compte</button>
            </div>
            <div class="col-sm-4 col-xs-4"></div>
            <div class="col-sm-4 col-xs-4">
              <button class="btn btn-success btn-block" type="submit" name="modif">Modifier</button>
            </div>
          </form>
<?php   } elseif (isset($_POST['modif'])) { ?>
          <form action="./include/account_inc.php" method="post">
            <div class="form-group">
              <label>Votre prénom</label>
  <?php echo '<input class="form-control" type="text" name="prenom" value="'.$_SESSION['prenom'].'" required>'; ?>
            </div>
            <div class="form-group">
              <label>Votre nom</label>
  <?php echo '<input class="form-control" type="text" name="nom" value="'.$_SESSION['nom'].'" required>'; ?>
            </div>
            <div class="form-group">
              <label>Votre adresse</label>
  <?php echo '<input class="form-control" type="text" name="adresse" value="'.$_SESSION['adresse'].'">'; ?>
            </div>
            <div class="form-group">
              <label>Votre ville</label>
  <?php echo '<input class="form-control" type="text" name="ville" value="'.$_SESSION['ville'].'" required>'; ?>
            </div>
            <div class="form-group">
              <label>Votre region</label>
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
              <label>Votre email</label>
  <?php echo '<input class="form-control" type="text" name="email" value="'.$_SESSION['email'].'" required>'; ?>
            </div>
            <div class="form-group">
              <label>Votre téléphone</label>
  <?php echo '<input class="form-control" type="text" name="tel" value="'.$_SESSION['tel'].'">'; ?>
            </div>

            <!-- Changer de mot de passe -->
            <div class="form-group">
              <label>Votre mot de passe actuel</label>
              <input class="form-control" type="password" name="old_pass" placeholder="********">
            </div>
            <div class="form-group">
              <label>Votre nouveau mot de passe</label>
              <input class="form-control" type="password" name="new_pass" placeholder="********">
            </div>
            <div class="form-group">
              <label>Confirmer le mot de passe</label>
              <input class="form-control" type="password" name="conf_pass" placeholder="********">
            </div>

            <div class="col-sm-4 "></div>
            <div class="col-sm-4 col-xs-6">
              <button class="btn btn-warning btn-block" type="submit" name="annuler">Annuler</button> <!-- passer en submit ?? -->
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

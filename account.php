<?php
require_once('header.php');
?>
<link rel="stylesheet" href="./css/account.css" />

<div class="tab">

<a href="account.php?tab=mes_annonces">Mes annonces</a>
<a href="account.php?tab=mon_compte">Mon compte</a>
</div>

<?php
require './include/dbh.php';

$Regions = ["Alsace", "Aquitaine", "Auvergne", "Basse-Normandie", "Bourgogne",
"Bretagne", "Centre", "Champagne-Ardenne", "Corse", "Franche-Comté",
"Haute-Normandie", "Ile-de-France", "Languedoc-Roussillon", "Limousin",
"Lorraine", "Midi-Pyrénées", "Nord-Pas-de-Calais", "Pays de la Loire",
"Picardie", "Poitou-Charentes", "Provence-Alpes-Côte d'Azur", "Rhône-Alpes"];

$user_id = $_SESSION['id'];
if (isset($_GET['tab'])) {
  $tab = $_GET['tab'];
} else {
  $tab = 'mes_annonces';
}

if ( $tab == 'mes_annonces') {
  $sql = "SELECT * FROM publication WHERE user_id='$user_id'";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  if ($resultCheck >= 1) {
    while($row = mysqli_fetch_assoc($result)) {
      echo "<div class='container'>";
      echo "<a href='annonce.php?annonce=".$row['id']."'>";

      if (!is_null($row["file1"])) {
        echo "<img class='pub_pic' alt='' src='./data/".$row["file1"]."'/><br />";
      } else {
        echo "<img class='pub_pic' alt='' src='./data/no_image.jpg'/><br />";
      }

      echo "<h3 class='item1' >".$row['title']."</h3>";
      echo "<p class='prix' >".$row['prix']." €</p>";
      echo "<p class='despt' >".$row['despt']."</p>";
      echo "<p class='date' >".$row['date']."</p>";
      echo "</a>";
      echo "<form action='./include/delete.php' method='get'>
      <button type='submit' name='delete' value='".$row['id']."'>Supprimer</button>
      </form>";
      echo "</div>";
    }
  }
}

if ( $tab == 'mon_compte') {
  if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == 'empty') {
      echo '<div class="alert alert-danger">
              <strong>Certains champs n\'ont pas été remplis.</strong>
            </div>';
    } if ($error == 'invalid') {
      echo '<div class="alert alert-danger">
              <strong>Certains caractères ne sont pas autorisés.</strong>
            </div>';
    } if ($error == 'wrongemail') {
      echo '<div class="alert alert-danger">
              <strong>Email invalide.</strong>
            </div>';
    } if ($error == 'bad_pass') {
      echo '<div class="alert alert-danger">
              <strong>L\'ancien mot de passe ne correspond pas.</strong>
            </div>';
    } if ($error == 'bad_conf') {
      echo '<div class="alert alert-danger">
              <strong>Les nouveaux mot de passe ne correspondent pas.</strong>
            </div>';
    } if ($error == 'success') {
      echo '<div class="alert alert-success">
              <strong>Vos modifications ont été appliquées.</strong>
            </div>';
    }
  }
  if (!isset($_POST['modif'])) {
    echo '<form class="form" action="./account.php?tab=mon_compte" method="post">';

    echo "<div class='entree'>";
    echo "<p class='text'> Votre prénom : </p>";
    echo "<p class='session'>".$_SESSION['prenom']."</p>";
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre nom : </p>";
    echo "<p class='session'>".$_SESSION['nom']."</p>";
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre adresse : </p>";
    echo "<p class='session'>".$_SESSION['adresse']."</p>";
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre ville : </p>";
    echo "<p class='session'>".$_SESSION['ville']."</p>";
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre region : </p>";
    echo "<p class='session'>".$_SESSION['region']."</p>";
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre email : </p>";
    echo "<p class='session'>".$_SESSION['email']."</p>";
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre téléphone : </p>";
    echo "<p class='session'>".$_SESSION['tel']."</p>";
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre mot de passe : </p>";
    echo "<p class='session'> <strong>********</strong> </p>";
    echo "</div>";

    echo '<button type="submit" name="modif">Modifier</button>';
  }
  if (isset($_POST['modif'])) {
    echo '<form class="form" action="./include/account_inc.php" method="post">';
    echo "<div class='entree'>";
    echo "<p class='text'> Votre prénom : </p>";
    echo '<input type="text" name="prenom" value="'.$_SESSION['prenom'].'" required autofocus/>';
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre nom : </p>";
    echo '<input type="text" name="nom" value="'.$_SESSION['nom'].'" required />';
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre adresse : </p>";
    echo '<input type="text" name="adresse" value="'.$_SESSION['adresse'].'" />';
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre ville : </p>";
    echo '<input type="text" name="ville" value="'.$_SESSION['ville'].'" required />';
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre région : </p>";
    echo '<select  name="region" required>';
            foreach($Regions as $region) {
              echo '<option value="'.$region.'">'.$region.'</option>';
            }
    echo '</select>';
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre email : </p>";
    echo '<input type="text" name="email" value="'.$_SESSION['email'].'" required />';
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre téléphone : </p>";
    echo '<input type="text" name="tel" value="'.$_SESSION['tel'].'"/>';
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre mot de passe actuel : </p>";
    echo '<input type="password" name="old_pass" value=""/>';
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Votre nouveau mot de passe : </p>";
    echo '<input type="password" name="new_pass" value=""/>';
    echo "</div>";

    echo "<div class='entree'>";
    echo "<p class='text'> Confirmation : </p>";
    echo '<input type="password" name="conf_pass" value=""/>';
    echo "</div>";

    echo '<button type="submit" name="enreg">Enregistrer</button>';
    echo '<button type="reset" name="annul">Annuler</button>';
  }
  echo '</form>';
}
?>

<?php
require_once('footer.php');
?>

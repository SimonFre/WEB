<?php
require_once('header.php');

$Regions = ["Alsace", "Aquitaine", "Auvergne", "Basse-Normandie", "Bourgogne",
"Bretagne", "Centre", "Champagne-Ardenne", "Corse", "Franche-Comté",
"Haute-Normandie", "Ile-de-France", "Languedoc-Roussillon", "Limousin",
"Lorraine", "Midi-Pyrénées", "Nord-Pas-de-Calais", "Pays de la Loire",
"Picardie", "Poitou-Charentes", "Provence-Alpes-Côte d'Azur", "Rhône-Alpes"];

?>

<link rel="stylesheet" href="./css/sign.css" />
  <div class="form">

    <form class="login-form" action="./include/signup_inc.php" method="post">
      <h2>Inscription</h2>
<?php
if (isset($_GET['signup'])) {
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
}
?>
      <input type="text" name="nom"
<?php if(isset($_POST['nom'])) {
        echo 'value="'.$_POST['nom'].'"';
      } else {
        echo 'placeholder="Nom *"';
      } ?>
      required/>
      <input type="text" name="prenom" placeholder="Prénom *" required/>
      <input type="text" name="adresse" placeholder="Adresse"/>
      <input type="text" name="ville" placeholder="Ville *" required/>
<?php echo '<select  name="region" required>
              <option value="unselectable_region" selected="selected" disabled>Sélectionnez une région : *</option>';
              foreach($Regions as $region) {
                echo '<option value="'.$region.'">'.$region.'</option>';
              }
      echo '</select>'; ?>
      <input type="text" name="email" placeholder="Email *" required/>
      <input type="text" name="tel" placeholder="Téléphone"/>
<?php   if (isset($_GET['signup'])) {
          if ($signup == 'pwd') {
            echo '<div class="alert alert-danger">
              <strong>Les mots de passe ne correspondent pas.</strong>
            </div>';
          }
        }
?>
      <input type="password" name="pwd1" placeholder="Mot de passe *" required/>
      <input type="password" name="pwd2" placeholder="Confirmation *" required/>
      <button type="submit" name="submit">S'inscrire</button>
    </form>
  </div>


<?php
require_once('footer.php');
?>

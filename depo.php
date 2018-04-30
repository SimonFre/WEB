<?php
require_once('header.php');
?>

<link rel="stylesheet" href="./css/depo.css" />
<?php

$Regions = ["Alsace", "Aquitaine", "Auvergne", "Basse-Normandie", "Bourgogne",
"Bretagne", "Centre", "Champagne-Ardenne", "Corse", "Franche-Comté",
"Haute-Normandie", "Ile-de-France", "Languedoc-Roussillon", "Limousin",
"Lorraine", "Midi-Pyrénées", "Nord-Pas-de-Calais", "Pays de la Loire",
"Picardie", "Poitou-Charentes", "Provence-Alpes-Côte d'Azur", "Rhône-Alpes"];

$Vehicules = ["Voitures", "Motos", "Utilitaires", "Equipement Auto",
"Equipement Moto"];
$Multimedia = ["Informatique","Consoles & Jeux vidéo", "Image & Son",
"Téléphonie"];
$Maison = ["Ameublement", "Electroménager", "Décoration", "Bricolage",
"Jardinage", "Vêtements", "Chaussures", "Accessoires & Bagagerie",
"Montres & Bijoux", "Equipement bébé", "Vêtements bébé"];
$Loisirs = ["DVD / Films", "CD / Musique", "Livres", "Animaux", "Vélos",
"Sports & Hobbies", "Instruments de musique", "Collection", "Jeux & Jouets"];
$Materiel = ["Matériel Agricole", "Transport - Manutention",
"BTP - Chantier Gros-oeuvre", "Outillage - Matériaux 2nd-oeuvre",
"Équipements Industriels", "Restauration - Hôtellerie", "Fournitures de Bureau",
"Commerces & Marchés", "Matériel Médical"];

if (isset($_SESSION['email'])) {
  echo '<div class="form">
       <form class="login-form" action="./include/depo_inc.php" method="POST" enctype="multipart/form-data">
          <h2>Déposer une annonce</h2>';
  if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == 'heavy') {
      echo '<div class="alert alert-danger">
              <strong>Image trop lourde.</strong>
            </div>';
    } if ($error == 'error') {
      echo '<div class="alert alert-danger">
              <strong>Une erreur est survenu.</strong>
            </div>';
    } if ($error == 'format') {
      echo '<div class="alert alert-danger">
              <strong>Fichier non supporté.</strong>
            </div>';
    } if ($error == 'prix') {
      echo '<div class="alert alert-danger">
              <strong>Prix invalide.</strong>
            </div>';
    }
  }

  echo '<div class="element_file">
      <input name="file" type="file" />  <!-- multiple="" -->
      </div>
      <div class="title">
        <input type="text" name="titre" placeholder="Titre de l\'annonce" required/><br />
      </div>
      <textarea name="subject" placeholder="Description"></textarea><br />

      <select  name="categorie" required>
      <option selected="selected" disabled>Sélectionnez une catégorie : </option>
      <option class="unselectable_cat" disabled> -- Vehicule -- </option>';
      foreach($Vehicules as $vehicule) {
        echo '<option value="'.$vehicule.'">'.$vehicule.'</option>';
      }
      echo '<option class="unselectable_cat" disabled> -- Multimédia -- </option>';
      foreach($Multimedia as $multimedia) {
        echo '<option value="'.$multimedia.'">'.$multimedia.'</option>';
      }
      echo '<option class="unselectable_cat" disabled> -- Maison -- </option>';
      foreach($Maison as $maison) {
        echo '<option value="'.$maison.'">'.$maison.'</option>';
      }
      echo '<option class="unselectable_cat" disabled> -- Loisirs -- </option>';
      foreach($Loisirs as $loisirs) {
        echo '<option value="'.$loisirs.'">'.$loisirs.'</option>';
      }
      echo '<option class="unselectable_cat" disabled> -- Matériel professionnel -- </option>';
      foreach($Materiel as $materiel) {
        echo '<option value="'.$materiel.'">'.$materiel.'</option>';
      }
      echo '</select>

      <select  name="region" required>
      <option value="unselectable_region" selected="selected" disabled>Sélectionnez une région :</option>';
      foreach($Regions as $region) {
        echo '<option value="'.$region.'">'.$region.'</option>';
      }
      echo '</select>

      <div class="price">
        <input type="number" name="prix" step="0.01" min="1" max="50000" placeholder="Prix" required />
        <i class="fa fa-eur" aria-hidden="true"></i>
      </div><br>
      <button type="submit" name="publier">Publier</button>
    </form>
  </div>';
} else {
  echo '<div class="alert alert-danger">
          <strong>Vous devez être connecté !</strong>
        </div>';
}
?>

<?php
require_once('footer.php');
?>

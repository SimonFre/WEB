<!-- Page de recherche -->
<?php
require_once('header.php');
require './include/list_inc.php';
?>
<link rel="stylesheet" href="./css/depo.css">
<article>
  <div class="container">
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h1>Rechercher une annonce</h1>
        <form action="./search_inc.php" method="post">
          <div class="form-group">
            <input type="text" class="form-control" name="nom" placeholder="Que rechercher-vous ?">
          </div>
          <div class="form-group">
            <select class="form-control" name="categorie">
              <option value="" selected>Toutes catégories</option>
              <optgroup label="Véhicule">
  <?php       foreach($Vehicules as $vehicule) {
                echo '<option value="'.$vehicule.'">'.$vehicule.'</option>';
              } ?>
              </optgroup>
              <optgroup label="Multimédia">
  <?php       foreach($Multimedia as $multimedia) {
                echo '<option value="'.$multimedia.'">'.$multimedia.'</option>';
              } ?>
              </optgroup>

              <optgroup label="Maison">
  <?php       foreach($Maison as $maison) {
                echo '<option value="'.$maison.'">'.$maison.'</option>';
              } ?>
              </optgroup>

              <optgroup label="Loisirs">
  <?php       foreach($Loisirs as $loisirs) {
                echo '<option value="'.$loisirs.'">'.$loisirs.'</option>';
              } ?>
              </optgroup>

              <optgroup label="Matériel professionnel">
  <?php       foreach($Materiel as $materiel) {
                echo '<option value="'.$materiel.'">'.$materiel.'</option>';
              } ?>
              </optgroup>
            </select>
          </div>
          <div class="form-group">
            <select class="form-control" name="region">
              <option value="" selected>Toute la france</option>
  <?php       foreach($Regions as $region) {
                echo '<option value="'.$region.'">'.$region.'</option>';
              } ?>
            </select>
          </div>
          <div class="form-group">
            <div class="col-sm-6">
              <div class="input-group">
                <input type="text" class="form-control" name="prix_min" placeholder="Prix min" maxlength="8" disabled/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-eur"></i></span>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="input-group" style="margin-bottom: 15px;">
                <input type="text" class="form-control" name="prix_max" placeholder="Prix max" maxlength="8" disabled/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-eur"></i></span>
              </div>
            </div>
            <!-- date ?-->
          </div>
          <button class="btn btn-info btn-block" type="submit" name="search">Rechercher</button>
        </form>
      </div>
      <div class="col-sm-3"></div>
    </div>
  </div>
</article>

<?php
require_once('footer.php');
?>

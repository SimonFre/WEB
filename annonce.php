<?php
require_once('header.php');

require './include/dbh.php';

$id = $_GET['annonce'];

$sql = "SELECT * FROM publication WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$title = $row['title'];
$despt = $row['despt'];
$categorie = $row['categorie'];
$region = $row['region'];
$prix = $row['prix'];
$date = $row['date'];

/*
if (!empty($row["file1"])) {
  echo "Pas vide!";
  echo '<img src="./data/'.$row["file1"].'" alt="" style="height:150px">';
} else {
  echo "Vide!";
  echo '<img src="./data/no_image.jpg" alt="" style="height:150px">';
}
*/
require_once('footer.php');
?>

<article>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-8">
        <img class="img-responsive" src="./data/5ae9c8242edad1.14326874.jpg" alt="">
      </div>
      <div class="col-md-4 col-sm-4">
        <div class="jumbotron"> <!--  Panel ?? // style="margin-top:25%;" -->
          <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
              <img class="img-circle" src="./data/default-user-image.png" alt="" width="40px">
            </div>
            <div class="col-sm-4"></div>
            <!-- Mettre le nom de l'auteur en dessous ?? -->
          </div>
          <p>Simon Frégard</p>
          <button class="btn btn-primary" data-toggle="collapse" data-target="#numero">N° de Téléphone</button>
          <button class="btn btn-warning" data-toggle="collapse" data-target="#email">Email</button>
          <div id="numero" class="collapse">
            <p>N° de téléphone</p>
          </div>
          <div id="email" class="collapse">
            <p>Email</p>
          </div>
        </div>
      </div>
    </div>
  </div>


</article>

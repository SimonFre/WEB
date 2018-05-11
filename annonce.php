<!-- Page d'annonce -->
<?php
require_once('header.php');

require './include/dbh.php';

if (isset($_GET['annonce']) && !empty($_GET['annonce'])) {
  $id = $_GET['annonce'];

  $sql = "SELECT * FROM publication WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $user_id = $row['user_id'];
  $file1 = $row['file1'];
  $file2 = $row['file2'];
  $file3 = $row['file3'];
  $title = $row['title'];
  $despt = $row['despt'];
  $categorie = $row['categorie'];
  $region = $row['region'];
  $prix = $row['prix'];
  $date = $row['date'];

  $sql = "SELECT * FROM users WHERE id='$user_id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  $user_nom = $row['nom'];
  $user_prenom = $row['prenom'];
  $user_ville = $row['ville'];
  $user_region = $row['region'];
  $user_telephone = $row['telephone'];
  $user_email = $row['email'];
?>

  <article>
    <div class="container">
      <div class="row" style="margin-bottom:20px;">
        <div class="col-md-8 col-sm-8">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
              <style>
                .carousel-inner img {
                  margin: auto;
                }
              </style>

          <?php if ($file1 == "NULL" && $file2 == "NULL" && $file3 == "NULL") {
        echo '<div class="item active">
                  <img class="img-responsive" src="./data/no_image.jpg" alt="" />
              </div>';
                } elseif ($file1 == "NULL" && $file2 != "NULL" ||
                          $file1 == "NULL" && $file3 != "NULL") {
                  if ($file2 != "NULL") {
        echo '<div class="item active">
                <img class="img-responsive" src="./data/'.$file2.'" alt="" />
              </div>';
                    if ($file3 != "NULL") {
        echo '<div class="item">
                <img class="img-responsive" src="./data/'.$file3.'" alt="" />
              </div>';
                    }
                  } else {
        echo '<div class="item active">
                <img class="img-responsive" src="./data/'.$file3.'" alt="" />
              </div>';
                  }
                } else {
        echo '<div class="item active">
                <img class="img-responsive" src="./data/'.$file1.'" alt="" />
              </div>';
                  if ($file2 != "NULL") {
      echo '<div class="item">
              <img class="img-responsive" src="./data/'.$file2.'" alt="" />
            </div>';
                  }
                  if ($file3 != "NULL") {
      echo '<div class="item">
              <img class="img-responsive" src="./data/'.$file3.'" alt="" />
            </div>';
                  }
                } ?>
            </div>

            <!-- Left and right controls -->
    <?php if ($file1 != "NULL" && $file2 != "NULL" ||
              $file1 != "NULL" && $file3 != "NULL" ||
              $file2 != "NULL" && $file3 != "NULL") { ?>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
    <?php } ?>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="jumbotron"> <!--  Panel ?? // style="margin-top:25%;" -->
            <div class="row">
              <div class="col-sm-4"></div>
              <div class="col-sm-4">
                <!-- Si pas d'image de profile -->
                <img class="img-circle" src="./data/default-user-image.png" alt="" style="width:40px" />
              </div>
              <div class="col-sm-4"></div>
            </div>
            <?php echo "<p>".$user_prenom." ".$user_nom."</p>";
            if (empty($user_telephone)) {
              echo '<button class="btn btn-primary" data-toggle="collapse" data-target="#numero" disabled>N° de Téléphone</button>';
            } elseif (!empty($user_telephone)) {
              echo '<button class="btn btn-primary" data-toggle="collapse" data-target="#numero">N° de Téléphone</button>';
            } ?>
            <button class="btn btn-warning" data-toggle="collapse" data-target="#email">Email</button>
            <div id="numero" class="collapse">
              <?php echo "<p>".$user_telephone."</p>"; ?>
            </div>
            <div id="email" class="collapse">
              <?php echo "<p>".$user_email."</p>"; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title" style="font-size:20px;"><?php echo $title; ?></h3>
          <?php echo '<p style="text-align:right;font-size:20px;">'.$prix.' €</p>'; ?>
        </div>
        <div class="panel-body">
          <?php if (!empty($despt)) {
            echo $despt;
          } else {
            echo "<h5>Aucune description n'a été émise.</h5>";
          }?>
        </div>
        <div class="panel-footer">
          <?php echo $categorie; ?>
          <br>
          <?php echo $region.", le "; ?>
          <?php echo $date; ?>

        </div>
      </div>
    </div>
  </article>

<?php
require_once('footer.php');
}
else {
  header("Location:index.php");
  exit();
}?>

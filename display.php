<!-- Affichage des annonces en "tuiles" -->

<div class="panel panel-info fade in" id="panel">
  <div class="panel-heading">
    <a href="#" class="close" data-target="#panel" data-dismiss="alert" aria-label="close">&times;</a>
    <h3 class="panel-title">Projet de L1 Info</h3>
  </div>
  <div class="panel-body">
    Ceci est mon projet d'application web.
  </div>
</div>
<!-- Trier par : Date / Prix -->
<div class="row">
  <ul class="nav nav-pills" style="float:right">
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
      Trier par <span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li><a href="?order=date">Date</a></li>
        <li><a href="?order=prix">Prix</a></li>
      </ul>
    </li>
  </ul>
</div>

<article>
  <div class="container">

<?php
require './include/dbh.php';

// Pagination
$ParPage = 6;
$sql2 = "SELECT * FROM publication";
$result = mysqli_query($conn, $sql2);
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
      <div class="thumbnail" style="overflow:hidden;height:300px">

<?php echo '<a href="./annonce?annonce='.$row['id'].'">';
    if ($row["file1"] != "NULL") {
      echo '<img src="./data/'.$row["file1"].'" alt="" style="height:175px;">';
    } else {
      if ($row["file2"] != "NULL") {
        echo '<img src="./data/'.$row["file2"].'" alt="" style="height:175px;">';
      } else {
        if ($row["file3"] != "NULL") {
          echo '<img src="./data/'.$row["file3"].'" alt="" style="height:175px;">';
        } else {
          echo '<img src="./data/no_image.jpg" alt="" style="height:175px;">';
        }
      }
    } ?>

        <div class="caption">
          <div class="col-xs-8 col-sm-8 col-md-8">
<?php echo "<h4>".$row['title']."</h4>"; ?>
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4">

<?php
    echo "<p>".$row['prix']." €</p>";
    echo "<p style='height:40px;overflow:hidden'>".$row['categorie']."</p>";
    echo "<p>".$row['date']."</p>"; ?>
          </div>
        </div>
        </a>
      </div>
    </div>
<?php
  } ?>
  </div>
<?php
} else { ?>
  <h5>Aucun résultat.</h5>
<?php
} ?>

  </div>
</article>

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
require_once('footer.php');
?>

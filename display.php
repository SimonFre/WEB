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

<!--
<link rel="stylesheet" href="./css/account.css" />
-->

<article>
  <div class="container">

<?php
require './include/dbh.php';

$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck >= 1) { ?>
  <div class="row">
<?php
  while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="thumbnail" style="overflow:hidden; text-overflow:ellipsis;">

<?php echo '<a href="./annonce?annonce='.$row['id'].'">';
    if (!empty($row["file1"])) {
      echo '<img src="./data/'.$row["file1"].'" alt="" style="height:175px;">';
    } else { ?>
      <img src="./data/no_image.jpg" alt="" style="height:175px;">
<?php
    } ?>

        <div class="caption">
          <div class="col-xs-8 col-sm-8 col-md-8">
<?php echo "<h4>".$row['title']."</h4>"; ?>
          </div>
          <div class="col-xs-4 col-sm-4 col-md-4">

<?php
    echo "<p>".$row['prix']." €</p>";
    echo "<p>".$row['categorie']."</p>";
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

<div class="col-md-4"></div>
<div class="col-md-4">
  <ul class="pagination">
    <li class="disabled"><a href="#">&laquo;</a></li>
    <li class="active" disabled><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&raquo;</a></li>
  </ul>
</div>
<div class="col-md-4"></div>

<?php
require_once('footer.php');
?>

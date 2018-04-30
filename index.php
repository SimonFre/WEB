<?php
require_once('header.php');
?>


<h2>Projet L1</h2>
<p>Page d'acceuil du site.</p>


<link rel="stylesheet" href="./css/account.css" />
<?php

require './include/dbh.php';
$sql = "SELECT * FROM publication";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck >= 1) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<a href='annonce.php?annonce=".$row['id']."'>";
    echo "<div class='container'>";

    if (!is_null($row["file1"])) {
      echo "<img class='pub_pic' src='./data/".$row["file1"]."'/><br />";
    } else {
      echo "<img class='pub_pic' src='./data/no_image.jpg' height='150'/><br />";
    }

    echo "<h3 class='item1' >".$row['title']."</h3>";
    echo "<p class='prix' >".$row['prix']." €</p>";
    echo "<p class='despt' >".$row['despt']."</p>";
    echo "<p class='date' >".$row['date']."</p>";
    echo "</div>";
    echo "</a>";
  }
}
?>

<?php
require_once('footer.php');
?>

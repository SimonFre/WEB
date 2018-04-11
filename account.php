<?php
require_once('header.php');
?>
<link rel="stylesheet" href="./css/account.css" />

<h2>Mon compte</h2>
<p>
  Page de gestion du compte.
</p>

<?php

require './include/dbh.php';

$user_id = $_SESSION['id'];
$sql = "SELECT * FROM publication WHERE user_id='$user_id'";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck >= 1) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<a href='account.php?#annonce=".$row['id']."'>";
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
    echo "<form action='./include/delete.php?' method='get'>
            <button type='submit' name='delete' value='".$row['id']."'>Supprimer</button>
          </form>";
    echo "</div>";
    echo "</a>";
  }
}
?>

<?php
require_once('footer.php');
?>

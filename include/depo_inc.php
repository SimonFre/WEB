<?php
session_start();

if (isset($_POST['publier'])) {
  if (isset($_FILES['file1']) && !empty($_FILES['file1']['name'])) {
    $file1 = $_FILES['file1'];
    $fileName = $_FILES['file1']['name'];
    $fileTmpName = $_FILES['file1']['tmp_name'];
    $fileSize = $_FILES['file1']['size'];
    $fileError = $_FILES['file1']['error'];
    $fileType = $_FILES['file1']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
      if ($fileError == 0) {
        if ($fileSize < 5000000) { // = 5 Mo
          $fileNameNew = uniqid('', true).".".$fileActualExt;
          $fileDestination = "../data/".$fileNameNew;
          move_uploaded_file($fileTmpName, $fileDestination);
        } else {
          echo "Fichier Trop lourd";
          header("Location: ../depo.php?error=heavy");
  		    exit();
        }
      } else {
        echo "An error occured.";
  	    header("Location: ../depo.php?error=error");
  	    exit();
      }
    } else {
      echo "Format non supporter.";
  	  header("Location: ../depo.php?error=format");
	    exit();
    }
  } else {
    $fileNameNew = 'NULL';
  }

  require './dbh.php';
  $title = $_POST['titre'];
  $despt = $_POST['subject'];
  $categorie = $_POST['categorie'];
  $region = $_POST['region'];
  $prix = $_POST['prix'];

  if (!preg_match("/^[0-9,]*$/", $prix)) {
    header("Location: ../depo.php?error=prix");
    echo "Prix invalide";
    exit();
  } else {
    $user_id = $_SESSION['id'];
    $date = date('d/m/Y');
    if ($fileNameNew != "NULL") {
      $sql = "INSERT INTO publication (user_id, file1, title, despt, categorie, region, prix, date)
      VALUES ('$user_id', '$fileNameNew', '$title', '$despt', '$categorie', '$region', '$prix', '$date');";
    } else {
      $sql = "INSERT INTO publication (user_id, title, despt, categorie, region, prix, date)
      VALUES ('$user_id', '$title', '$despt', '$categorie', '$region', '$prix', '$date');";
    }
    mysqli_query($conn, $sql);
    header("Location: ../account.php");
    exit();
  }
} else {
  header("Location: ../depo.php");
  exit();
}
?>

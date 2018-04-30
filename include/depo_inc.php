<?php
session_start();

if (isset($_POST['publier'])) {
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

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
      }
    } else {
      echo "An error occured.";
    }
  } else {
    echo "Format non supporter.";
  }
}

require_once('dbh.php');
$title = $_POST['titre'];
$despt = $_POST['subject'];
$prix = $_POST['prix'];

if (!preg_match("/^[0-9]*$/", $prix)) {
  header("Location: ../depo.php?error");
  echo "Prix invalide";
  exit();
} else {
  $user_id = $_SESSION['id'];
  $date = date('d/m/Y');
  $sql = "INSERT INTO publication (user_id, file1, title, despt, prix, date)
  VALUES ('$user_id', '$fileNameNew', '$title', '$despt', '$prix', '$date');";
  mysqli_query($conn, $sql);
  header("Location: ../account.php");
  exit();
}
?>

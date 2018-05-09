<!-- Vérification d'un annonce pour la publier ou la modifier -->
<?php
session_start();

if (isset($_POST['publier']) || isset($_POST['modifier'])) {
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
          $fileNameNew1 = uniqid('', true).".".$fileActualExt;
          $fileDestination = "../data/".$fileNameNew1;
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
    $fileNameNew1 = 'NULL';
  }
  if (isset($_FILES['file2']) && !empty($_FILES['file2']['name'])) {
    $file2 = $_FILES['file2'];
    $fileName = $_FILES['file2']['name'];
    $fileTmpName = $_FILES['file2']['tmp_name'];
    $fileSize = $_FILES['file2']['size'];
    $fileError = $_FILES['file2']['error'];
    $fileType = $_FILES['file2']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
      if ($fileError == 0) {
        if ($fileSize < 5000000) { // = 5 Mo
          $fileNameNew2 = uniqid('', true).".".$fileActualExt;
          $fileDestination = "../data/".$fileNameNew2;
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
    $fileNameNew2 = 'NULL';
  }
  if (isset($_FILES['file3']) && !empty($_FILES['file3']['name'])) {
    $file3 = $_FILES['file3'];
    $fileName = $_FILES['file3']['name'];
    $fileTmpName = $_FILES['file3']['tmp_name'];
    $fileSize = $_FILES['file3']['size'];
    $fileError = $_FILES['file3']['error'];
    $fileType = $_FILES['file3']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($fileActualExt, $allowed)) {
      if ($fileError == 0) {
        if ($fileSize < 5000000) { // = 5 Mo
          $fileNameNew3 = uniqid('', true).".".$fileActualExt;
          $fileDestination = "../data/".$fileNameNew3;
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
    $fileNameNew3 = 'NULL';
  }
  /* Vérifcation fichiers
  if ($fileNameNew2 == "NULL" && $fileNameNew3 != "NULL") {
    $fileNameNew2 = $fileNameNew3;
    $fileNameNew3 = "NULL";
  }
  if ($fileNameNew1 == "NULL" && $fileNameNew2 != "NULL") {
    $fileNameNew1 = $fileNameNew2;
    $fileNameNew2 = "NULL";
  }
  */
  require './dbh.php';
  $title = $_POST['titre'];
  $despt = $_POST['subject'];
  $categorie = $_POST['categorie'];
  $region = $_POST['region'];
  $prix = $_POST['prix'];

  if (!preg_match("/^[0-9,]*$/", $prix) || $prix < 0) {
    header("Location: ../depo.php?error=prix");
    echo "Prix invalide";
    exit();
  } else {
    $user_id = $_SESSION['id'];
    $date = date('d/m/Y');
    if (isset($_POST['publier']) || !isset($_POST['modifier'])) {
      $sql = "INSERT INTO publication (user_id, file1, file2, file3, title, despt, categorie, region, prix, date)
        VALUES ('$user_id', '$fileNameNew1', '$fileNameNew2', '$fileNameNew3', '$title', '$despt', '$categorie', '$region', '$prix', '$date');";

    } elseif (!isset($_POST['publier']) || isset($_POST['modifier'])) {
      $id = $_GET['edit'];

      $sql = "SELECT * FROM publication WHERE id = '$id';";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      // Si $row['file1'] est vide et que $fileNameNew1 != vide
      if ($fileNameNew1 != "NULL") {
        $sql = "UPDATE publication SET file1 = '$fileNameNew1' WHERE id ='$id';";
        mysqli_query($conn, $sql);
        unlink("../data/".$row['file1'].""); // Supprimer le fichier local de l'image
      }
      if ($fileNameNew2 != "NULL") {
        $sql = "UPDATE publication SET file2 = '$fileNameNew2' WHERE id ='$id';";
        mysqli_query($conn, $sql);
        unlink("../data/".$row['file2']."");
      }
      if ($fileNameNew3 != "NULL") {
        $sql = "UPDATE publication SET file3 = '$fileNameNew3' WHERE id ='$id';";
        mysqli_query($conn, $sql);
        unlink("../data/".$row['file3']."");
      }

      $sql = "UPDATE publication SET
        title = '$title',
        despt = '$despt',
        categorie = '$categorie',
        region = '$region',
        prix = '$prix',
        date = '$date' WHERE id ='$id';";
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

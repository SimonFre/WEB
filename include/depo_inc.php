<?php
if (isset($_POST['publier'])) {
  $file = $_FILES['file'];

  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png';

  if (in_array($fileActualExt, $allowed)) {
    if ($fileError == 0) {
      if ($fileSize < 5000000) { // = 5 Mo
        $fileNameNew = uniqid('', true).".".$fileActualExt;
        $fileDestination = "../data/".$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
        header("Location: ../index.php?upload_success");
        exit();
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

?>

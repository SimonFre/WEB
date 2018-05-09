<!-- Création d'un compte utilisateur -->
<?php
session_start();

if (isset($_POST['submit'])) {

  require 'dbh.php';

  $nom = mysqli_real_escape_string($conn, $_POST['nom']);
  $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
  $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
  $ville = mysqli_real_escape_string($conn, $_POST['ville']);
  $region = mysqli_real_escape_string($conn, $_POST['region']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $tel = mysqli_real_escape_string($conn, $_POST['tel']);
  $pwd1 = mysqli_real_escape_string($conn, $_POST['pwd1']);
  $pwd2 = mysqli_real_escape_string($conn, $_POST['pwd2']);

  // Error handler
  // Check for empty fields
  if (empty($nom) || empty($prenom) || empty($ville) || empty($region) ||
  empty($email) || empty($pwd1) || empty($pwd2)) {
    header("Location: ../signup.php?signup=empty");
    exit();
  } else {
    // Check if input character are valid
    if (!preg_match("/^\p{L}+[-]*$/ui", $nom) ||
        !preg_match("/^\p{L}+[-]*$/ui", $prenom) ||
        !empty($adresse) && !preg_match("/^[a-zA-Z0-9 -]+$/ui", $adresse) ||
        !preg_match("/^\p{L}+[-]*$/ui", $ville ) ||
        !empty($tel) && !preg_match("/^\d{8}/ui", $tel)) {
      header("Location: ../signup.php?signup=invalid");
      exit();
    } else {
      // Check if email is valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?signup=wrongemail");
        exit();
      } else {
        // Check if email already exist in database
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($resultCheck > 0) {
          header("Location: ../signup.php?signup=email");
          exit();
        } else {
          // Check if password are the same
          if ($pwd1 != $pwd2) {
            header("Location: ../signup.php?signup=pwd");
            exit();
          } else {
            // Hashing the password
            $hashedpwd = password_hash($pwd1, PASSWORD_DEFAULT);
            // Insert the user into the database
            $sql = "INSERT INTO users (nom, prenom, adresse, ville, region, telephone,
              email, password) VALUES ('$nom', '$prenom', '$adresse', '$ville', '$region',
              '$tel', '$email', '$hashedpwd');";
            mysqli_query($conn, $sql);
            header("Location: ../signin.php?signup=success");
            exit();
          }
        }
      }
    }
  }
} else {
  header("Location: ../signup.php");
  exit();
}

?>

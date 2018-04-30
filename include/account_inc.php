<?php
session_start();

if (isset($_POST['enreg'])) {

  require 'dbh.php';

  $id = $_SESSION['id'];
  $nom = mysqli_real_escape_string($conn, $_POST['nom']);
  $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
  $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
  $ville = mysqli_real_escape_string($conn, $_POST['ville']);
  $region = mysqli_real_escape_string($conn, $_POST['region']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $tel = mysqli_real_escape_string($conn, $_POST['tel']);
  $old_pass = mysqli_real_escape_string($conn, $_POST['old_pass']);
  $new_pass = mysqli_real_escape_string($conn, $_POST['new_pass']);
  $conf_pass = mysqli_real_escape_string($conn, $_POST['conf_pass']);
  // ...

  if (empty($nom) || empty($prenom) || empty($ville) || empty($region) ||
    empty($email)) {
    header("Location: ../account.php?tab=mon_compte&error=empty");
    exit();
  } else {
    // region == Okay
    $sql = "UPDATE users SET region = '$region' WHERE id = '$id'";
    mysqli_query($conn, $sql);

    $_SESSION['region'] = $region;
    // Check if input character are valid

    if (!preg_match("/^\p{L}+[-]*$/ui", $nom) ||
        !preg_match("/^\p{L}+[-]*$/ui", $prenom) ||
        !empty($adresse) && !preg_match("/^[a-zA-Z0-9 -]+$/ui", $adresse) ||
        !preg_match("/^[a-zA-Z -]*$/", $ville ) ||
        !empty($tel) && !preg_match("/^\d{8}/ui", $tel)) {
      header("Location: ../account.php?tab=mon_compte&error=invalid");
      exit();
    } else {
      // Nom, prenom, adresse, ville, telephone == Okay
      $sql = "UPDATE users SET nom = '$nom', prenom = '$prenom', adresse = '$adresse',
      ville = '$ville', telephone = '$tel' WHERE id = '$id'";
      mysqli_query($conn, $sql);

      $_SESSION['nom'] = $nom;
      $_SESSION['prenom'] = $prenom;
      $_SESSION['adresse'] = $adresse;
      $_SESSION['ville'] = $ville;
      $_SESSION['tel'] = $tel;
      // Check if email is valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../account.php?tab=mon_compte&error=wrongemail");
        exit();
      } else {
        // Check if email already exist in database
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if ($email != $_SESSION['email'] && $resultCheck > 0 ) {
          header("Location: ../account.php?tab=mon_compte&error=wrongemail");
          exit();
        } else {
          // Email == Okay
          $sql = "UPDATE users SET email = '$email' WHERE id = '$id'";
          mysqli_query($conn, $sql);

          $_SESSION['email'] = $email;
        }
      }
    }
  }
  if (!empty($old_pass) && !empty($new_pass) && !empty($conf_pass)) {
    // code...
    // Check password changing
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    // Selection de l'utilisateur
    if ($row = mysqli_fetch_assoc($result)) {
      // Vérification de l'ancien mot de passe
      $hashedpwdCheck = password_verify($old_pass, $row['password']);
      if ($hashedpwdCheck == false) {
        // Si l'ancien n'est pas le bon
        header("Location: ../account.php?tab=mon_compte&error=bad_pass");
        exit();
      } elseif ($hashedpwdCheck == true) {
        // Si c'est le bon
        // Est-ce que les nouveaux mot de passe correspondent ?
        if ($new_pass != $conf_pass) {
          // Si correspondent pas
          header("Location: ../account.php?tab=mon_compte&error=bad_conf");
          exit();
        } elseif ($new_pass == $conf_pass) {
          // Si correspondent
          $hashedpwd = password_hash($new_pass, PASSWORD_DEFAULT); // Hashage
          // Update du password
          $sql = "UPDATE users SET password = '$hashedpwd' WHERE id = '$id'";
          mysqli_query($conn, $sql);
          // Réussite
          header("Location: ../account.php?tab=mon_compte&error=success");
          exit();
        }
      }
    }
    // Si il y à un champs pass non vide
  } elseif (!empty($old_pass) || !empty($new_pass) || !empty($conf_pass)) {
    header("Location: ../account.php?tab=mon_compte&error=empty");
    exit();
  } else {
    header("Location: ../account.php?tab=mon_compte");
    exit();
  }
} else {
  header("Location: ../account.php?tab=mon_compte");
  exit();
}
?>

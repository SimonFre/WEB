<?php
session_start();
unset($_SESSION['error']);
if (isset($_POST['submit'])) {

  include 'dbh.php';

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

  if (empty($email) || empty($pwd)) {
    header("Location: ../signin.php?login=empty");
    $_SESSION['error'] = 'Formulaire vide';
    exit();
  } else {
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
      header("Location: ../signin.php?login=error");
      $_SESSION['error'] = 'Mauvais Email ou Mot de passe';
      exit();
    } else {
      if ($row = mysqli_fetch_assoc($result)) {
        // De-hashing the password
        $hashedpwdCheck = password_verify($pwd, $row['password']);
        if ($hashedpwdCheck == false) {
          header("Location: ../signin.php?login=error");
          $_SESSION['error'] = 'Mauvais Email ou Mot de passe';
          exit();
        } elseif ($hashedpwdCheck == true) {
          // Log in the user in
          $_SESSION['prenom'] = $row['prenom'];
          $_SESSION['nom'] = $row['nom'];
          $_SESSION['adresse'] = $row['adresse'];
          $_SESSION['ville'] = $row['ville'];
          $_SESSION['email'] = $row['email'];
          header("Location: ../index.php?login=success");
          exit();
        }
      }
    }
  }
} else {
  header("Location: ../signin.php?login=error");
  $_SESSION['error'] = 'Tu as crus !';
  exit();
}

?>

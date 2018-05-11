<!-- Connexion de l'utilisateur -->
<?php
session_start();
unset($_SESSION['temp_email']);

if (isset($_POST['submit'])) {
  require 'dbh.php';

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

  if (empty($email) || empty($pwd)) {
    header("Location: ../signin.php?login=empty");
    exit();
  } else {
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck < 1) {
      header("Location: ../signin.php?login=error");
      exit();
    } else {
      if ($row = mysqli_fetch_assoc($result)) {
        // De-hashing the password
        $hashedpwdCheck = password_verify($pwd, $row['password']);
        if ($hashedpwdCheck == false) {
          header("Location: ../signin.php?login=error");
          exit();
        } elseif ($hashedpwdCheck == true) {
          unset($_SESSION['temp_email']);
          // Log in the user
          $_SESSION['id'] = $row['id'];
          $_SESSION['prenom'] = $row['prenom'];
          $_SESSION['nom'] = $row['nom'];
          $_SESSION['adresse'] = $row['adresse'];
          $_SESSION['ville'] = $row['ville'];
          $_SESSION['region'] = $row['region'];
          $_SESSION['email'] = $row['email'];
          $_SESSION['tel'] = $row['telephone'];
          header("Location: ../index.php");
          exit();
        }
      }
    }
  }
} else {
  header("Location: ../signin.php?login=error");
  exit();
}

?>

<?php
require_once('header.php');
session_start();
?>

<link rel="stylesheet" href="./css/signup.css" />
<div class="login-page">
  <div class="form">

    <form class="login-form">
      <input type="text" placeholder="username"/>
      <input type="password" placeholder="password"/>
      <button>login</button>
      <p class="message">Not registered? <a href="signup.php">Create an account</a></p>
    </form>
  </div>
</div>

<?php
require_once('footer.php');
?>

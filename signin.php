<?php
require_once('header.php');
if (isset($_SESSION['error'])) {
  echo $_SESSION['error'];
}
?>

<link rel="stylesheet" href="./css/sign.css" />

<article>
  <div class="container">
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <h1>Connexion</h1>
<?php if (isset($_GET['signup'])) {
        $signup = $_GET['signup'];
        if ($signup == 'success') {
          echo '<div class="alert alert-success fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Votre compte a été crée.</strong>
                </div>';
        }
      }
      if (isset($_GET['login'])) {
        $signup = $_GET['login'];
        if ($signup == 'error') {
          echo '<div class="alert alert-danger fade in">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Mauvais Email ou Mot de passe</strong>
                </div>';
        }
      } ?>
        <form action="./include/signin_inc.php" method="post">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" class="form-control" name="email" placeholder="Email">
          </div>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" class="form-control" name="pwd" placeholder="Mot de passe">
          </div>
          <button class="btn btn-success btn-block" type="submit" name="submit">Se connecter</button>
        </form>
      </div>
      <div class="col-sm-4"></div>
    </div>
  </div>
</article>

<?php
require_once('footer.php');
?>

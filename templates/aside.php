<?php
  if (!isset($_SESSION['user']) || empty($_SESSION['user'])) { // user is not logged in

?>
<aside class="wrapper-signin">
  <div class="remove-signin">
    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
  </div>
  <a id="switch-signin" href ="#">Login</a>
  <form class="form-signin">
    <h2 class="form-signin-heading">Login</h2>
    <label for="inputEmail" class="sr-only">E-Mail-Adresse</label>
    <input type="email" id="inputEmail" class="form-control" placeholder="E-Mail-Adresse" required="" autofocus="">
    <label for="inputPassword" class="sr-only">Passwort</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
    <div class="checkbox">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="btn btn-default btn-block" type="submit">Sign in</button>
  </form>
  <p>
    <a href ="<?php echo ROOT_DIR.'register'; ?>">Registrieren</a>
  </p>
</aside>

<?php
  } else { // user is logged in
?>

<aside class="user-info">
  Welcome du User
  <img src="https://avatars3.githubusercontent.com/u/22323?v=3&s=460" />
</aside>

<?php
  }

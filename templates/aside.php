<?php
  if (!Auth::isLoggedIn()) { // user is not logged in

?>

<aside class="wrapper-signin hidden-xs">
  <div class="remove-signin">
    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
  </div>
  <button id="switch-signin" class="btn btn-sm btn-default">Sign in</button>
  <form class="form-signin" action="<?php echo ROOT_DIR; ?>login" method="post">
    <h2 class="form-signin-heading">Sign in</h2>
    <label for="inputEmail" class="sr-only">E-Mail-Adresse</label>
    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="E-Mail-Adresse" required="" autofocus="">
    <label for="inputPassword" class="sr-only">Passwort</label>
    <input name="pwd" type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
    <button class="btn btn-default" type="submit" name="submitted">Sign in</button>
  </form>
  <form class="form-register" action="<?php echo ROOT_DIR.'register'; ?>">
    <button class="btn btn-sm btn-default">Register</button>
  </p>
</aside>

<?php
  } else { // user is logged in
?>

<aside class="user-info hidden-xs">
  Welcome <?php echo $_SESSION['user']->getNickname(); ?>
  <img src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/p/4/005/051/200/29bb13c.jpg" />
</aside>

<?php
  }

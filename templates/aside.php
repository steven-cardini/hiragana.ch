<?php
  if (!Auth::isLoggedIn()) { // user is not logged in

?>

<aside class="wrapper-signin hidden-xs">
  <div class="remove-signin">
    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
  </div>
  <button id="switch-signin" class="btn btn-sm btn-default"><?php echo I18n::t('text.signin'); ?></button>
  <form class="form-signin" action="<?php echo ROOT_DIR; ?>login" method="post">
    <h2 class="form-signin-heading"><?php echo I18n::t('text.signin'); ?></h2>
    <label for="inputEmail" class="sr-only"><?php echo I18n::t('text.email'); ?></label>
    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="<?php echo I18n::t('text.email'); ?>" required="" autofocus="">
    <label for="inputPassword" class="sr-only"><?php echo I18n::t('text.password'); ?></label>
    <input name="pwd" type="password" id="inputPassword" class="form-control" placeholder="<?php echo I18n::t('text.password'); ?>" required="">
    <button class="btn btn-default" type="submit" name="submitted"><?php echo I18n::t('text.signin'); ?></button>
  </form>
  <form class="form-register" action="<?php echo ROOT_DIR.'register'; ?>">
    <button class="btn btn-sm btn-default"><?php echo I18n::t('text.register'); ?></button>
  </p>
</aside>

<?php
  } else { // user is logged in
?>

<aside class="user-info hidden-xs hidden-sm">
  <?php echo I18n::t('text.welcome').' '.$_SESSION['user']->getNickname(); ?>
  <img src="<?php echo ROOT_DIR.IMG_DIR.'user_icon.jpg'; ?>" />
</aside>

<?php
  }

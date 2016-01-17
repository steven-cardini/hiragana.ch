<h1><?php echo I18n::t('login.title'); ?></h1>

<?php

$FIELD_EMAIL = 'email';
$FIELD_PWD   = 'pwd';

$displayForm = true;

// FORM WAS SUBMITTED
if (isset($_POST['submitted'])) {

  // validate user input server-side (use of exceptions in order to be able to add other error checks)
  try {

    // ensure that user filled out all compulsory fields
    if (empty($_POST[$FIELD_EMAIL]) || empty($_POST[$FIELD_PWD])) {
      throw new Exception (I18n::t('login.err.notallfields'));
    }

    // prevent HTML and SQL injection
    $email = htmlspecialchars($_POST[$FIELD_EMAIL]);
    $email = DB::escapeString($email);
    $email = strtolower($email);

    $pw = $_POST[$FIELD_PWD];

    // check if login data is valid and correct
    if (!Auth::checkLogin($email, $pw)) {
      throw new Exception (I18n::t('login.err.notcorrect'));
    }

  } catch (Exception $e) {
    $errorMessage = $e->getMessage();
  }


  // validation is successful
  if (!isset($errorMessage)) {
    $displayForm = false;
    // perform the actual login
    $user = User::getUserByEmail($email);

    if (!$user || is_null($user)) {
      $message = I18n::t('login.err.general');
    } else {
      // save user object to session
      $_SESSION['user'] = $user;
      // determine where to redirect user to
      if (isset($_SESSION['REQUEST_URI']) && !empty($_SESSION['REQUEST_URI'])) {
        $redirectTo = $_SESSION['REQUEST_URI'];
        unset($_SESSION['REQUEST_URI']);
      } else {
        $redirectTo = 'index.php';
      }
      FileFunctions::log("redirecting to $redirectTo ..");
      header("location:$redirectTo");
    }

    echo $message;
  }

} // end if isset submitted


// DISPLAY FORM
if ($displayForm) {
 ?>

<p>
  <?php echo I18n::t('login.text'); ?>
</p>

<?php
  // display server side error if present
  if (isset($errorMessage)) {
    echo '<div class="alert alert-danger" role="alert">'.$errorMessage.'</div>';
  } elseif (isset($_SESSION['REQUEST_URI'])) {
    echo '<div class="alert alert-warning" role="alert">'.I18n::t('login.pleaselogin').'</div>';
  }

  // pre-fill text fields if possible
  $email = isset($email) ? $email : "";
 ?>

<form class="form-horizontal js-register-form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

  <div class="form-group email">
    <label for="<?php echo $FIELD_EMAIL; ?>" class="control-label col-sm-2"><?php echo I18n::t('text.email'); ?></label>
    <div class="col-sm-6 input-group">
      <input class="form-control" id ="<?php echo $FIELD_EMAIL; ?>" type="email" name="<?php echo $FIELD_EMAIL; ?>" required="required" value="<?php echo $email; ?>" placeholder="<?php echo I18n::t('login.youremail'); ?>" aria-describedby="helpEmail"/>
    </div>
  </div>

  <div class="form-group pw">
    <label for="<?php echo $FIELD_PWD; ?>" class="control-label col-sm-2"><?php echo I18n::t('text.password'); ?></label>
    <div class="col-sm-6 input-group">
      <input class="form-control" id="<?php echo $FIELD_PWD; ?>" type="password" name="<?php echo $FIELD_PWD; ?>" required="required" placeholder="<?php echo I18n::t('login.yourpwd'); ?>" />
    </div>
  </div>

  <button type="submit" class="btn btn-default" name="submitted"><?php echo I18n::t('text.signin'); ?></button>

</form>

<?php

} // end if display form

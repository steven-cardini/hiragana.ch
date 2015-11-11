<h1>Login</h1>

<?php

$FIELD_EMAIL = 'email';
$FIELD_PWD   = 'pwd';

$displayForm = true;

// FORM WAS SUBMITTED
if (isset($_POST['submitted'])) {

  // validate user input server-side
  try {

    // ensure that user filled out all compulsory fields
    if (empty($_POST[$FIELD_EMAIL]) || empty($_POST[$FIELD_PWD])) {
      throw new Exception ("Please fill out all fields.");
    }

    // prevent HTML and SQL injection
    $email = htmlspecialchars($_POST[$FIELD_EMAIL]);
    $email = DB::escapeString($email);
    $email = strtolower($email);

    $pw = $_POST[$FIELD_PWD];

    // check if login data is valid and correct
    if (!Auth::checkLogin($email, $pw)) {
      throw new Exception ("Your login is not valid. Please try again.");
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
      $message = "There was a problem with your login. Please try again.";
    } else {
      $_SESSION['user'] = $user;
      header("location:index.php");
    }

    echo $message;
  }

} // end if isset submitted


// DISPLAY FORM
if ($displayForm) {
 ?>

<p>
  Bitte geben Sie unten Ihre Login-Daten ein, um sich einzuloggen.
</p>

<?php
  // display server side error if present
  if (isset($errorMessage)) {
    echo '<div class="alert alert-danger" role="alert">'.$errorMessage.'</div>';
  }

  // pre-fill text fields if possible
  $email = isset($email) ? $email : "";
 ?>

<form class="form-horizontal js-register-form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

  <div class="form-group email">
    <label for="<?php echo $FIELD_EMAIL; ?>" class="control-label col-sm-2">E-Mail-Adresse</label>
    <div class="col-sm-6">
      <input class="form-control" id ="<?php echo $FIELD_EMAIL; ?>" type="email" name="<?php echo $FIELD_EMAIL; ?>" required="required" value="<?php echo $email; ?>" aria-describedby="helpEmail"/>
    </div>
  </div>

  <div class="form-group pw">
    <label for="<?php echo $FIELD_PWD; ?>" class="control-label col-sm-2">Passwort</label>
    <div class="col-sm-6">
      <input class="form-control" id="<?php echo $FIELD_PWD; ?>" type="password" name="<?php echo $FIELD_PWD; ?>" required="required" />
    </div>
  </div>

  <button type="submit" class="btn btn-default" name="submitted">Login</button>

</form>

<?php

} // end if display form

<h1>Registrierung</h1>

<?php

  $FIELD_NICKNAME = 'nickname';
  $FIELD_EMAIL    = 'email';
  $FIELD_PWD      = 'pwd';
  $FIELD_PWD2     = 'pwd-repeat';

  $displayForm = true;

  // FORM WAS SUBMITTED
  if (isset($_POST['submitted'])) {

    // validate user input server-side
    try {

      // ensure that user filled out all compulsory fields
      if (empty($_POST[$FIELD_NICKNAME]) || empty($_POST[$FIELD_EMAIL]) || empty($_POST[$FIELD_PWD]) || empty($_POST[$FIELD_PWD2])) {
        throw new Exception ("Please fill out all fields.");
      }

      // prevent HTML and SQL injection
      $nickname = htmlspecialchars($_POST[$FIELD_NICKNAME]);
      $email = htmlspecialchars($_POST[$FIELD_EMAIL]);
      $nickname = DB::escapeString($nickname);
      $email = DB::escapeString($email);
      $email = strtolower($email);

      $pw = $_POST[$FIELD_PWD];
      $pw_repeat = $_POST[$FIELD_PWD2];

      // check if passwords match
      if ($pw !== $pw_repeat) {
        throw new Exception ("Please provide two identical passwords.");
      }

      // check if nickname is unique
      if (User::nicknameIsRegistered($nickname)) {
        throw new Exception ("A user with this nickname already exists.");
      }

      // check if e-mail is unique
      if (User::emailIsRegistered($email)) {
        throw new Exception ("Your e-mail address is already registered.");
      }

      // check if e-mail address is valid
      if (!preg_match("/^\S+@\S+\.\S+$/", $email)) {
        throw new Exception ("Please provide a valid e-mail address.");
      }

    } catch (Exception $e) {
      $errorMessage = $e->getMessage();
    }


    // validation is successful
    if (!isset($errorMessage)) {
      $displayForm = false;
      // perform the actual user registration (store user to DB)
      $user = User::createUser($nickname, $email, $pw);

      if ($user==false)
        $message = "There was a problem creating the user";
      else
        $message = "Thank you for your registration!<br \> Nickname = $nickname<br \> E-Mail = $email";

      echo $message;
    }

  }

// DISPLAY FORM
if ($displayForm) {
 ?>

<p>
  Bitte füllen Sie die Angaben unten aus, um sich zu registrieren.
</p>

<?php
  // display server side error if present
  if (isset($errorMessage)) {
    echo '<div class="alert alert-danger" role="alert">'.$errorMessage.'</div>';
  }

  // pre-fill text fields if possible
  $nickname = isset($nickname) ? $nickname : "";
  $email = isset($email) ? $email : "";

 ?>

<form class="form-horizontal js-register-form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

  <div class="form-group nickname">
    <label for="<?php echo $FIELD_NICKNAME; ?>" class="control-label col-sm-2">Nickname</label>
    <div class="col-sm-6">
      <input class="form-control" id="<?php echo $FIELD_NICKNAME; ?>" name="<?php echo $FIELD_NICKNAME; ?>" required="required" value="<?php echo $nickname; ?>" aria-describedby="helpNickname"/>
    </div>
  </div>

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

  <div class="form-group pw">
    <label for="<?php echo $FIELD_PWD2; ?>" class="control-label col-sm-2">Passwort wiederholen</label>
    <div class="col-sm-6">
      <input class="form-control" id="<?php echo $FIELD_PWD2; ?>" type="password" name="<?php echo $FIELD_PWD2; ?>" required="required" aria-describedby="helpPW"/>
    </div>
  </div>

  <button type="submit" class="btn btn-default" name="submitted">Registrieren</button>

</form>

<?php

} // end if display form

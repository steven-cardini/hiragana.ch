<h1>Registrierung</h1>

<?php

  $displayForm = true;

  // FORM WAS SUBMITTED
  if (isset($_POST['submitted'])) {

    // prevent HTML and SQL injection
    $nickname = htmlspecialchars($_POST['nickname']);
    $email = htmlspecialchars($_POST['email']);
    $nickname = DB::escapeString($nickname);
    $email = DB::escapeString($email);

    $pw = $_POST['pw'];
    $pw_repeat = $_POST['pw-repeat'];

    // validate user input server-side
    try {

      // check if user filled out all fields
      if (empty($nickname) || empty($email) || empty($pw) || empty($pw_repeat)) { // check if compulsory fields are not empty
        throw new Exception ("Please fill out all fields.");
      }

      // check if passwords match
      if ($pw !== $pw_repeat) {
        throw new Exception ("Please provide two identical passwords.");
      }

      // check if nickname is unique
      $test = User::getUserByNickname($nickname);
      if (isset($test) && $test!=null) {
        throw new Exception ("A user with this nickname already exists.");
      }

      // check if e-mail is unique
      $test = User::getUserByEmail($email);
      if (isset($test) && $test!=null) {
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
 ?>

<form class="form-horizontal js-register-form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

  <div class="form-group nickname">
    <label for="nickname" class="control-label col-sm-2">Nickname</label>
    <div class="col-sm-6">
      <input class="form-control" id="nickname" name="nickname" aria-describedby="helpNickname"/>
    </div>
  </div>

  <div class="form-group email">
    <label for="email" class="control-label col-sm-2">E-Mail-Adresse</label>
    <div class="col-sm-6">
      <input class="form-control" id ="email" type="email" name="email" required="required" aria-describedby="helpEmail"/>
    </div>
  </div>

  <div class="form-group pw">
    <label for="pw" class="control-label col-sm-2">Passwort</label>
    <div class="col-sm-6">
      <input class="form-control" id="pw" type="password" name="pw" required="required" />
    </div>
  </div>

  <div class="form-group pw">
    <label for="pw-repeat" class="control-label col-sm-2">Passwort wiederholen</label>
    <div class="col-sm-6">
      <input class="form-control" id="pw-repeat" type="password" name="pw-repeat" required="required" aria-describedby="helpPW"/>
    </div>
  </div>

  <button type="submit" class="btn btn-default" name="submitted">Registrieren</button>

</form>

<?php

} // end if display form

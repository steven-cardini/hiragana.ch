<h1>Registrierung</h1>

<?php

  $displayForm = true;

  if (isset($_POST['submitted'])) {
    $nickname = htmlspecialchars($_POST['nickname']);
    $email = htmlspecialchars($_POST['email']);
    $pw = htmlspecialchars($_POST['pw']);
    $pw_repeat = htmlspecialchars($_POST['pw-repeat']);

    // validate user input on server side
    if (empty($nickname) || empty($email) || empty($pw) || empty($pw_repeat)) { // check if compulsory fields are not empty
      $error = 'Please fill out all fields.';
    } elseif ($pw !== $pw_repeat) { // check if passwords match
      $error = 'Please provide two identical passwords.';
    }

    //TODO: check if nickname and e-mail-address are unique

    //TODO: check if e-mail-address is valid

    // validation is successful
    if (!isset($error)) {
      $displayForm = false;
      $pw = md5($pw);
      $message = "Thank you for your registration!<br \> Nickname = $nickname<br \> E-Mail = $email<br \> Password hash = $pw";
      echo $message;
    }

  }


if ($displayForm) {
 ?>


<p>
  Bitte füllen Sie die Angaben unten aus, um sich zu registrieren.
</p>

<?php
// display server side error if present
  if (isset($error)) {
    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
  }
 ?>

<script src="lib/js/validate_registration.js" type="text/javascript" charset="utf-8"></script>

<form class="form-horizontal js-register-form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

  <div class="form-group nickname">
    <label for="nickname" class="control-label col-sm-2">Nickname</label>
    <div class="col-sm-6">
      <input class="form-control" id="nickname" name="nickname" />
    </div>
  </div>

  <div class="form-group email">
    <label for="email" class="control-label col-sm-2">E-Mail-Adresse</label>
    <div class="col-sm-6">
      <input class="form-control" id ="email" type="email" name="email" required="required"/>
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
      <input class="form-control" id="pw-repeat" type="password" name="pw-repeat" required="required" />
    </div>
  </div>

  <button type="submit" class="btn btn-default" name="submitted">Registrieren</button>

</form>

<?php

} // end if display form

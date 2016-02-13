<h1><?php echo I18n::t('feedback.title'); ?></h1>

<?php

  $FIELD_NAME = 'name';
  $FIELD_EMAIL = 'email';
  $FIELD_TEXT = 'text';

  $MESSAGE_TO = "contact@hiragana.ch";
  $MESSAGE_SUBJECT = 'Neue Nachricht über hiragana.ch';

  $displayForm = true;

  // FORM WAS SUBMITTED
  if (isset($_POST['submitted'])) {

    // validate user input server-side
    try {

      // ensure that user filled out all compulsory fields
      if (empty($_POST[$FIELD_NAME]) || empty($_POST[$FIELD_EMAIL]) || empty($_POST[$FIELD_TEXT])) {
        throw new Exception (I18n::t('form.err.notallfields'));
      }

      // prevent HTML injection
      $name = htmlspecialchars($_POST[$FIELD_NAME]);
      $email = htmlspecialchars($_POST[$FIELD_EMAIL]);
      $text = htmlspecialchars($_POST[$FIELD_TEXT]);

      // check if name length is ok
      if (!preg_match('/^\w{3,40}$/', $name)) {
        throw new Exception (I18n::t('feedback.err.namelength'));
      }

      // check if e-mail address is valid
      if (!preg_match("/^\S+@\S+\.\S+$/", $email)) {
        throw new Exception (I18n::t('form.err.emailnotvalid'));
      }

      // check if text is at least 3 chars long
      if (!preg_match('/^.{3,}$/', $text)) {
        throw new Exception (I18n::t('feedback.err.textlength'));
      }

    } catch (Exception $e) {
      $errorMessage = $e->getMessage();
    }

    // validation is successful
    if (!isset($errorMessage)) {
      $displayForm = false;
      $MESSAGE_HEADERS = 'From: '.$email."\r\n";
      $MESSAGE_HEADERS .= 'MIME-Version: 1.0'."\r\n";
      $MESSAGE_HEADERS .= 'Content-type: text/html; charset=utf-8' . "\r\n";
      $MESSAGE_TEXT = '
      <html>
        <head>
          <title>'.$MESSAGE_SUBJECT.'</title>
        </head>
        <body>
          <p>Nachricht von '.$name.'</p>
          <p>'.$text.'</p>
        </body>
      </html>';

      // send message
      if (mail($MESSAGE_TO, $MESSAGE_SUBJECT, $MESSAGE_TEXT, $MESSAGE_HEADERS)) {
        $message = '<div class="alert alert-success" role="alert">'.I18n::t('feedback.success').'</div>';
      } else {
        $message = '<div class="alert alert-danger" role="alert">'.I18n::t('form.err.general').'</div>';
      }

      echo $message;

    }

  } // end if isset post submitted

  // DISPLAY FORM
  if ($displayForm) {
   ?>

<p>
  <?php echo I18n::t('feedback.text'); ?>
  <!--Hier kannst du mich kontaktieren. Ich freue mich über dein Feedback und auch über Vorschläge für die zukünftige Erweiterung der Website.-->
</p>

<?php
  // display server side error if present
  if (isset($errorMessage)) {
    echo '<div class="alert alert-danger" role="alert">'.$errorMessage.'</div>';
  }

  // pre-fill text fields if possible
  $name = isset($name) ? $name : "";
  $email = isset($email) ? $email : "";
  $text = isset($text) ? $text : "";

 ?>

  <form class="form-horizontal js-feedback-form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

    <div class="form-group name">
      <label for="<?php echo $FIELD_NAME; ?>" class="control-label col-sm-2">Name</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" id="<?php echo $FIELD_NAME; ?>" name="<?php echo $FIELD_NAME; ?>" required="required" value="<?php echo $name; ?>" aria-describedby="helpName" />
      </div>
    </div>

    <div class="form-group email">
      <label for="<?php echo $FIELD_EMAIL; ?>" class="control-label col-sm-2"><?php echo I18n::t('text.email'); ?></label>
      <div class="col-sm-6">
        <input type="email" class="form-control" id="<?php echo $FIELD_EMAIL; ?>" name="<?php echo $FIELD_EMAIL; ?>" required="required" value="<?php echo $email; ?>" aria-describedby="helpEmail" />
      </div>
    </div>

    <div class="form-group text">
      <label for="<?php echo $FIELD_TEXT; ?>" class="control-label col-sm-2"><?php echo I18n::t('feedback.title'); ?></label>
      <div class="col-sm-6">
        <textarea class="form-control" id="<?php echo $FIELD_TEXT; ?>" name="<?php echo $FIELD_TEXT; ?>" rows="6" required="required" aria-describedby="helpText"><?php echo $text; ?></textarea>
      </div>
    </div>

    <button type="submit" class="btn btn-default" name="submitted"><?php echo I18n::t('button.submit'); ?></button>

  </form>

  <?php

} // end if display form

// pass language strings to javascript
echo '<script>';
echo 'var err_namelength = '.json_encode(I18n::t('feedback.err.namelength')).';';
echo 'var err_emailnotvalid = '.json_encode(I18n::t('register.err.emailnotvalid')).';';
echo 'var err_textlength = '.json_encode(I18n::t('feedback.err.textlength')).';';
echo '</script>';

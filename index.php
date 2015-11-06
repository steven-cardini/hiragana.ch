<?php
  // include all relevant PHP files
  require_once('lib/php/control/include.routine.php');

  $currentPage = FileFunctions::getCurrentPage();
  $customJS = JavaScriptFunctions::getCustomJSFiles($currentPage);
  // set content language
  I18n::initialize();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>hiragana.ch</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="description" content="PHP Webshop">
  <meta name="keywords" content="hiragana katakana japanese PHP">
  <meta name="author" content="Steven Cardini, Raphael Laubscher">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?php echo ROOT_DIR.CSS_DIR; ?>style.css" media="screen">

</head>

<body>
  <div class="container">

    <?php
      // include page templates

      require_once(TEMPLATE_DIR.'banner.php');
      require_once(TEMPLATE_DIR.'navigation.php');
      require_once(TEMPLATE_DIR.'updates.php');
      require_once(TEMPLATE_DIR.'maincontent.php');
      require_once(TEMPLATE_DIR.'aside.php');
      require_once(TEMPLATE_DIR.'footer.php');

    ?>

  </div>

  <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
  <script src="<?php echo ROOT_DIR.JS_DIR; ?>application.js" type="text/javascript"></script>
  <?php
    foreach ($customJS as $JSFile) {
      echo '<script src="'.ROOT_DIR.JS_DIR.$JSFile.'"></script>';
    }
   ?>
</body>
</html>

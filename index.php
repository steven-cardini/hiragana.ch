<?php
  // include autoloader
  require_once('lib/php/autoloader.php');

  session_start();

  $currentPage = FileFunctions::getCurrentPage();
  $externalJS = JavaScriptIncluder::getExternalJSFiles($currentPage);
  $customJS = JavaScriptIncluder::getCustomJSFiles($currentPage);
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

  <link rel="stylesheet" href="<?php echo ROOT_DIR.LIB_DIR; ?>ext/bootstrap-3.3.5-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo ROOT_DIR.CSS_DIR; ?>style.css" media="screen">

  <?php
  foreach ($externalJS as $JSFile) {
    echo '<script src="'.$JSFile.'"></script>';
  } ?>

</head>

<body>
  <div ng-app="hiragana" class="container">

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

  <script src="<?php echo ROOT_DIR.LIB_DIR; ?>ext/jquery-1.11.3.min.js"></script>
  <script src="<?php echo ROOT_DIR.LIB_DIR; ?>ext/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
  <script src="<?php echo ROOT_DIR.JS_DIR; ?>application.js" type="text/javascript"></script>
  <?php
    foreach ($customJS as $JSFile) {
      echo '<script src="'.ROOT_DIR.JS_DIR.$JSFile.'"></script>';
    }
   ?>
</body>
</html>

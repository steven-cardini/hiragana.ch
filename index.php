<?php
  require_once('lib/php/control/include.routine.php');

  $currentPage = FileFunctions::getCurrentPage();
  $CUSTOM_JS = JavaScriptFunctions::getCustomJSFiles($currentPage);
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

  <link rel="stylesheet" href="<?php echo ROOT_DIR.EXT_DIR; ?>bootstrap-3.3.5-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo ROOT_DIR.CSS_DIR; ?>style.css" media="screen">

  <script src="<?php echo ROOT_DIR.EXT_DIR; ?>jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="<?php echo ROOT_DIR.EXT_DIR; ?>bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
  <script src="<?php echo ROOT_DIR.JS_DIR; ?>application.js" type="text/javascript"></script>
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
  <?php
    foreach ($CUSTOM_JS as $jsFile) {
      echo '<script src="'.ROOT_DIR.JS_DIR.$jsFile.'"></script>';
    }
   ?>
</body>
</html>

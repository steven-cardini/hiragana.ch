<?php
  // include constants
  require_once('lib/php/constants.php');
  // include classloader and register it to autoloading
  require_once('lib/php/classloader.php');
  spl_autoload_register('loadClass');
  // start session and save client
  session_start();
  // require_once('lib/php/functions/client.register.php');
  // set content language
  I18n::initialize();
  // load current page content and required JS files
  $currentPage = FileFunctions::getCurrentPage();
  $externalJS = JavaScriptIncluder::getExternalJSFiles($currentPage);
  $customJS = JavaScriptIncluder::getCustomJSFiles($currentPage);
?>
<!DOCTYPE html>
<html lang="<?php echo I18n::getLang(); ?>">

<head>
  <meta charset="utf-8">
  <title>hiragana.ch</title>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="description" content="Learn Hiragana and Katakana" />
  <meta name="keywords" content="hiragana katakana kana trainer japanese japanisch PHP" />
  <meta name="author" content="Steven Cardini, Raphael Laubscher" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  <link rel="icon" type="image/png" href="<?php echo ROOT_DIR; ?>/img/favicon.png" />
  <link rel="stylesheet" href="<?php echo ROOT_DIR.LIB_DIR; ?>ext/bootstrap-3.3.5-dist/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo ROOT_DIR.CSS_DIR; ?>style.css" media="screen" />

  <?php
  foreach ($externalJS as $JSFile) {
    echo '<script src="'.$JSFile.'"></script>';
  } ?>

</head>

<body>

  <?php require_once(TEMPLATE_DIR.'navigation.php'); // include navigation ?>
  <div class="container">
    <?php require_once(TEMPLATE_DIR.'maincontent.php'); // include main content ?>
  </div>
  <?php  require_once(TEMPLATE_DIR.'footer.php'); // include footer ?>

  <script>var ROOT_DIR = <?php echo json_encode(ROOT_DIR); ?></script>
  <script>var LANGUAGE = <?php echo json_encode(I18n::getLang()); ?></script>
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

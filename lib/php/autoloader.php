<?php
// this file defines constants for global access to directories, loads php classes and interfaces and sets content file for mainContent

// constants to access root directory, only use with HTML includes, not with PHP require_once!
// define ("ROOT_DIR", "/");      // PROD
define ("ROOT_DIR", "/hiragana.ch/");    // DEV

// constants to access subdirectories, important for PHP includes and for HTML includes in combination with ROOT_DIR
define ("LIB_DIR", "lib/");
define ("TEMPLATE_DIR", "templates/");
define ("PAGE_DIR", "pages/");
define ("IMG_DIR", "img/");

// LIB subfolders
define ("CSS_DIR", LIB_DIR."css/");
define ("JS_DIR", LIB_DIR."js/");
define ("PHP_DIR", LIB_DIR."php/");
define ("EXT_DIR", LIB_DIR."ext/");

// PHP subfolders
define ("AUTH_DIR", PHP_DIR."auth/");
define ("FUNCTIONS_DIR", PHP_DIR."functions/");
define ("CONTROLLER_DIR", PHP_DIR."controller/");
define ("MODEL_DIR", PHP_DIR."model/");
define ("VIEW_DIR", PHP_DIR."view/");

// function to automatically load PHP classes
function __autoload ($className) {
  $dirs = [
    AUTH_DIR,
    FUNCTIONS_DIR,
    CONTROLLER_DIR,
    MODEL_DIR,
    VIEW_DIR
  ];

  //try to load class
  foreach ($dirs as $dir) {
    $file = "$dir$className.class.php";
    if (file_exists($file)) {
      require_once($file);
      break;
    }
  }
}

// prepare content file for mainContent
// default page, loaded upon first site call
if (!isset($_GET['page']) || empty($_GET['page'])) {
  define("PAGE_SOURCE", "pages/home.php");
//page does not exist -> error page
} elseif (!file_exists('pages/'.$_GET['page'].'.php') || $_GET['page']=='error') {
  define("PAGE_SOURCE", "pages/error.php");
// page exists -> define appropriate page file
} else {
  define("PAGE_SOURCE", 'pages/'.$_GET['page'].'.php');
}
?>

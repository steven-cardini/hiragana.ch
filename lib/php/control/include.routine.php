<?php
// this file defines constants for global access to directories, loads php classes and interfaces and sets content file for mainContent

// constants to access root directory, only use with HTML includes, not with PHP require_once!
// define ("ROOT_DIR", "/");      // PROD
define ("ROOT_DIR", "/hiragana.ch/");    // DEV

// constants to access subdirectories, important for PHP includes and for HTML includes in combination with ROOT_DIR
define ("LIB_DIR", "lib/");
define ("CSS_DIR", LIB_DIR."css/");
define ("JS_DIR", LIB_DIR."js/");
define ("PHP_DIR", LIB_DIR."php/");
define ("EXT_DIR", LIB_DIR."ext/");
define ("CONTROL_DIR", PHP_DIR."control/");
define ("CLASSES_DIR", PHP_DIR."classes/");
define ("INTERFACES_DIR", PHP_DIR."interfaces/");
define ("TEMPLATE_DIR", "templates/");
define ("PAGE_DIR", "pages/");
define ("IMG_DIR", "img/");

// require static class file functions, this contains functions to require other files
// require PHP classes and interfaces
require_once(CLASSES_DIR.'filefunctions.class.php');
FileFunctions::requirePHPFiles (INTERFACES_DIR);
FileFunctions::requirePHPFiles (CLASSES_DIR);

// prepare content file for mainContent
// default page, loaded upon first site call
if (!isset($_GET['page']) || empty($_GET['page'])) {
  define("PAGE_SOURCE", "pages/home.php");
//page does not exist -> error page
} elseif (!file_exists('pages/'.$_GET['page'].'.php') || $_GET['page']=='error') {
  define("PAGE_SOURCE", "pages/error.php");
  define("PAGE_AREA", "Info");
// page exists -> define appropriate page file
} else {
  $tmp = explode('/', $_GET['page']);
  define("PAGE_SOURCE", 'pages/'.$_GET['page'].'.php');
  define("PAGE_AREA", $tmp[0]);
}
?>

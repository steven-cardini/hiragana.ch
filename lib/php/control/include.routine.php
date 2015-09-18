<?php
// this file defines constants for global acess to directories and initiates includes of php classes

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

require_once(CLASSES_DIR.'filefunctions.class.php');

// pageloader routine will load all datastructures and other PHP control files
require_once(CONTROL_DIR.'pageloader.routine.php');

?>

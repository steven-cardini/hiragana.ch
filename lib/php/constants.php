<?php

// PATH CONSTANTS
// constants to access root directory, only use with HTML includes, not with PHP require_once!
// define ("ROOT_DIR", "/");              // PROD
// define ("ROOT_DIR", "/beta/");          // PRE-PROD
define ("ROOT_DIR", "/hiragana.ch/");    // DEV

// constants to access subdirectories, important for PHP includes and for HTML includes in combination with ROOT_DIR
// differentiate between API call and normal page calls
$lib_dir = "lib/";
$template_dir = "templates/";
$page_dir = "pages/";
$img_dir = "img/";
if (isset($api_call)) {
  define ("LIB_DIR", "../$lib_dir");
  define ("TEMPLATE_DIR", "../$template_dir");
  define ("PAGE_DIR", "../$page_dir");
  define ("IMG_DIR", "../$img_dir");
} else {
  define ("LIB_DIR", "$lib_dir");
  define ("TEMPLATE_DIR", "$template_dir");
  define ("PAGE_DIR", "$page_dir");
  define ("IMG_DIR", "$img_dir");
}

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

// kana subfolders
define ("KANA_DIR", PAGE_DIR."kana/");
define ("HIRAGANA_DIR", KANA_DIR.'hiragana/');
define ("KATAKANA_DIR", KANA_DIR.'katakana/');


// PAGE_SOURCE in order to prepare content file for mainContent
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

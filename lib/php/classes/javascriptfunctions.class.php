<?php

class JavaScriptFunctions {

  private static $JS = array(
    'home' => array(),
    'kanatrainer' => array(
      'kanatrainer/hiraganahandler.class.js',
      'kanatrainer/alphabettrainer.class.js',
      'kanatrainer/alphabettrainer.control.js',
    ),
  );

  static function getCustomJSFiles ($currentPage) {
    return array_key_exists($currentPage, JavaScriptFunctions::$JS) ? JavaScriptFunctions::$JS[$currentPage] : array();
  }

}

<?php

class JavaScriptFunctions {

  private static $JS = array(
    'home' => array(),
    'hiragana' => array(
      'kanatrainer/hiraganahandler.class.js',
      'kanatrainer/hiragana.def.js',
      'kanatrainer/kanaselector.pagecontrol.js',
    ),
    'katakana' => array(
      'kanatrainer/katakanahandler.class.js',
      'kanatrainer/katakana.def.js',
      'kanatrainer/kanaselector.pagecontrol.js',
    ),
    'kanatrainer' => array(
      'kanatrainer/hiraganahandler.class.js',
      'kanatrainer/kanatrainer.class.js',
      'kanatrainer/kanatrainer.pagecontrol.js',
    ),
  );

  static function getCustomJSFiles ($currentPage) {
    return array_key_exists($currentPage, JavaScriptFunctions::$JS) ? JavaScriptFunctions::$JS[$currentPage] : array();
  }

}

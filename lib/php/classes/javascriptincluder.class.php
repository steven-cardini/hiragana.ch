<?php

class JavaScriptIncluder {

  private static $JS = array(
    'home' => array(),
    'hiragana' => array(
      'kanatrainer/hiraganahandler.class.js',
      'kanatrainer/hiragana.def.js',
      'kanatrainer/kanaselector.controller.js'
    ),
    'katakana' => array(
      'kanatrainer/katakanahandler.class.js',
      'kanatrainer/katakana.def.js',
      'kanatrainer/kanaselector.controller.js'
    ),
    'kanatrainer' => array(
      'kanatrainer/hiraganahandler.class.js',
      'kanatrainer/katakanahandler.class.js',
      'kanatrainer/evaluationstatistics.class.js',
      'kanatrainer/kanatrainer.class.js',
      'kanatrainer/kanatrainer.controller.js'
    ),
    'kanaresults' => array(
      'kanatrainer/hiraganahandler.class.js',
      'kanatrainer/katakanahandler.class.js',
      'kanatrainer/evaluationstatistics.class.js',
      'kanatrainer/kanatrainer.class.js',
      'kanatrainer/kanaresults.controller.js'
    ),
    'register' => array(
      'validate_registration.js'
    )
  );

  static function getCustomJSFiles ($currentPage) {
    return array_key_exists($currentPage, JavaScriptIncluder::$JS) ? JavaScriptIncluder::$JS[$currentPage] : array();
  }

}

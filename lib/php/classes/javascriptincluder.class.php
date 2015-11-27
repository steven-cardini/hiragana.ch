<?php

class JavaScriptIncluder {

  private static $customJS = array(
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
    ),
    'lessontutorial' => array(
      'lessontutorial.pagecontrol.js'
    )
  );

  private static $externalJS = array(
    'lessontutorial' => array(
      'lib/ext/ckeditor/ckeditor.js'
    )
  );

  static function getCustomJSFiles ($currentPage) {
    return array_key_exists($currentPage, JavaScriptIncluder::$customJS) ? JavaScriptIncluder::$customJS[$currentPage] : array();
  }

  static function getExternalJSFiles ($currentPage) {
    return array_key_exists($currentPage, JavaScriptIncluder::$externalJS) ? JavaScriptIncluder::$externalJS[$currentPage] : array();
  }

}

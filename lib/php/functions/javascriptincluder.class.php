<?php

class JavaScriptIncluder {

  private static $customJS = array(
    'home' => array(),
    'kana/hiragana/learn' => array(
      'kana/area.def.js',
      'kana/hiraganahandler.class.js',
      'kana/kanalearn.controller.js'
    ),
    'kana/katakana/learn' => array(
      'kana/area.def.js',
      'kana/katakanahandler.class.js',
      'kana/kanalearn.controller.js'
    ),
    'kana/hiragana/select' => array(
      'kana/area.def.js',
      'kana/hiraganahandler.class.js',
      'kana/kanaselector.controller.js'
    ),
    'kana/katakana/select' => array(
      'kana/area.def.js',
      'kana/katakanahandler.class.js',
      'kana/kanaselector.controller.js'
    ),
    'kana/hiragana/trainer' => array(
      'kana/area.def.js',
      'kana/hiraganahandler.class.js',
      'kana/evaluationstatistics.class.js',
      'kana/kanatrainer.class.js',
      'kana/kanatrainer.controller.js'
    ),
    'kana/katakana/trainer' => array(
      'kana/area.def.js',
      'kana/katakanahandler.class.js',
      'kana/evaluationstatistics.class.js',
      'kana/kanatrainer.class.js',
      'kana/kanatrainer.controller.js'
    ),
    'kana/hiragana/results' => array(
      'kana/area.def.js',
      'kana/hiraganahandler.class.js',
      'kana/evaluationstatistics.class.js',
      'kana/kanatrainer.class.js',
      'kana/kanaresults.controller.js'
    ),
    'kana/katakana/results' => array(
      'kana/area.def.js',
      'kana/katakanahandler.class.js',
      'kana/evaluationstatistics.class.js',
      'kana/kanatrainer.class.js',
      'kana/kanaresults.controller.js'
    ),
    'feedback' => array(
      'form-validation/feedback.validation.js'
    ),
    'register' => array(
      'validate_registration.js'
    ),
    'admin/exerciseadmin' => array(
      'exerciseadmin.controller.js'
    ),
    'admin/tutorialadmin' => array(
      'modifylessontutorial.controller.js'
    ),
    'usersettings' => array(
      'angular/color_controller.js'
    )
  );

  private static $externalJS = array(
    'admin/tutorialadmin' => array(
      '//cdn.ckeditor.com/4.5.5/standard/ckeditor.js'
    ),
    'usersettings' => array(
      '//ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js'
    )
  );

  static function getCustomJSFiles ($currentPage) {
    return array_key_exists($currentPage, JavaScriptIncluder::$customJS) ? JavaScriptIncluder::$customJS[$currentPage] : array();
  }

  static function getExternalJSFiles ($currentPage) {
    return array_key_exists($currentPage, JavaScriptIncluder::$externalJS) ? JavaScriptIncluder::$externalJS[$currentPage] : array();
  }

}

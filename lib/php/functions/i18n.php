<?php

  class I18n {

    private static $i18n = array(
                      'navigation.home' => array(
                        'de' => 'Startseite',
                        'en' => 'Home'
                      ),
                      'navigation.word_trainer' => array(
                        'de' => 'Wörter Trainer',
                        'en' => 'Word Trainer'
                      )
                    );

    static function t($key) {
      $lang = $_SESSION['lang'];

      return isset(I18n::$i18n[$key][$lang]) ? I18n::$i18n[$key][$lang]
                                       : "Missing translation [$key]";
    }

  }

?>

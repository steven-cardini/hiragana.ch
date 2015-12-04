<?php

  class I18n {

    private static $language;

    private static $i18n = array(
                      'navigation.home' => array(
                        'de' => 'Startseite',
                        'en' => 'Home'
                      ),
                      'navigation.japanese' => array(
                        'de' => 'Japanisch Kurse',
                        'en' => 'Japanese Courses'
                      )
                    );

    static function t($key) {
      return isset(I18n::$i18n[$key][self::$language]) ? I18n::$i18n[$key][self::$language]
                                       : "Missing translation [$key]";
    }

    static function initialize() {
      if(!isset($_COOKIE['lang'])) {
        self::$language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        setcookie('lang', self::$language);
      } else {
        self::$language = $_COOKIE['lang'];
      }
    }
  }

?>

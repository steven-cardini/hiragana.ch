<?php

class Common {

  public static function get_param($name, $default) {
    return isset($_GET[$name]) ? urldecode($_GET[$name]) : $default;
  }

}

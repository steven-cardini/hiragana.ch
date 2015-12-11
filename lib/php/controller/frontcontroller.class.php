<?php
class FrontController {

  private static $controller;

  public static function display (Controller $controller) {
    self::$controller = $controller;
    self::doAction();
  }

  private static function doAction () {
    if (isset($_POST['action']) && method_exists(self::$controller, $_POST['action'])) {
      $action = htmlspecialchars($_POST['action']);
      self::$controller->{$action}();
    } else {
      self::$controller->defaultAction();
    }
  }
}

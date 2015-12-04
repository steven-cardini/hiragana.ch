<?php
class FrontController {

  private $controller;

  public function __construct (Controller $controller) {
    $this->controller = $controller;
  }

  public function display () {
    if (isset($_POST['action'])) {
      $action = htmlspecialchars($_POST['action']);
      $this->controller->{$action}();
    } else {
      $this->controller->defaultAction();
    }
  }
}

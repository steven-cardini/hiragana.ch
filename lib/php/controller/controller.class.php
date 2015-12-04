<?php
abstract class Controller {

  protected $view;

  public function __construct () {
  }

  public function defaultAction () {
    $this->view->render();
  }

  public function getView() {
    return $this->view;
  }


}

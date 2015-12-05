<?php
abstract class View {

  private $errorMessage;
  private $warnMessage;
  private $successMessage;
  private $contentBefore;
  private $contentAfter;

  public function __construct () {
    $this->errorMessage = '';
    $this->warnMessage = '';
    $this->successMessage = '';
    $this->contentBefore = '';
    $this->contentAfter = '';
  }

  public function render() {
    echo $this->errorMessage;
    echo $this->warnMessage;
    echo $this->successMessage;
    echo $this->contentBefore;
    echo $this->getContent();
    echo $this->contentAfter;
  }

  abstract protected function getContent();

  public function addErrorMessage($message) {
    $this->errorMessage = "<div class='alert alert-danger' role='alert'>$message</div>";
  }

  public function addWarnMessage($message) {
    $this->warnMessage = "<div class='alert alert-warning' role='alert'>$message</div>";
  }

  public function addSuccessMessage($message) {
    $this->successMessage = "<div class='alert alert-success' role='alert'>$message</div>";
  }

  protected function addContentBefore($content) {
    $this->contentBefore = $content;
  }

  protected function addContentAfter($content) {
    $this->contentAfter = $content;
  }

}

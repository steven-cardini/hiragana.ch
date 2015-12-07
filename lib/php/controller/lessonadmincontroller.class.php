<?php
class LessonAdminController extends Controller {

  protected $view;
  private $course;

  public function __construct() {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
      die ("Please first select a course!");
    }
    $courseId = $this->secureString($_GET['id']);
    $this->course = Course::getCourseById($courseId);
    $this->view = new LessonAdminView($this->course);
  }

  public function defaultAction() {
    //TODO: do some stuff?
    parent::defaultAction();
  }

}

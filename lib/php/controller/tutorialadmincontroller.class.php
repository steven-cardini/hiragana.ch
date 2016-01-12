<?php
class TutorialAdminController extends Controller {

  protected $view;
  private $lesson;
  private $course;

  public function __construct() {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
      die ("Please first select a lesson!");
    }

    $lessonId = $this->secureString($_GET['id']);
    $this->lesson = Lesson::getLesson($lessonId);
    $this->course = Course::getCourseById($this->lesson->getCourseId());
    $this->view = new TutorialAdminView($this->lesson, $this->course);
  }

  public function defaultAction() {
    parent::defaultAction();
  }

}

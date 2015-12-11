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
    $this->getView()->addAddButton();
    parent::defaultAction();
  }

  public function addLesson() {
    $this->getView()->addNewLessonInput();
    parent::defaultAction();
  }

  public function saveNewLesson() {
    if (!isset($_POST['nameEN']) || empty($_POST['nameEN']) || !isset($_POST['nameDE']) || empty($_POST['nameDE']) || !isset($_POST['points']) || empty($_POST['points'])) {
      $this->getView()->addErrorMessage('Please fill out all fields!');
      $this->addLesson();
    } else {
      $courseId = $this->secureString($_GET['id']);
      $nameEN = $this->secureString($_POST['nameEN']);
      $nameDE = $this->secureString($_POST['nameDE']);
      $points = $this->secureString($_POST['points']);
      if (Lesson::createLesson($courseId, $nameEN, $nameDE, $points)) {
        $this->getView()->addSuccessMessage('Lesson was successfully added.');
      } else {
        $this->getView()->addErrorMessage('Lesson could not be added!');
      }
      $this->defaultAction();
      // create default tutorial page
      $newLesson = Lesson::getNewestLesson($courseId);
      $lessonId = $newLesson->getId();
      $filePath = PAGE_DIR."lessons/$courseId-$lessonId.html";
      FileFunctions::createFile($filePath, "New lesson <strong>".$newLesson->getName('en')."</strong>");
    }
  }

  public function deleteLesson() {
    if (isset($_POST['confirmed']) && $_POST['confirmed']==='true') {
      $id = $this->secureString($_POST['lessonId']);
      if (Lesson::deleteLesson($id)) {
        $this->getView()->addSuccessMessage('Lesson was successfully deleted.');
      } else {
        $this->getView()->addErrorMessage('Lesson could not be deleted!');
      }
    } else {
      $this->getView()->addWarnMessage('Are you sure you want to delete this lesson?');
      $this->getView()->addDeleteConfirmation();
    }
    $this->defaultAction();
  }

}

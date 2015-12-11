<?php
class CourseAdminController extends Controller {

  protected $view;

  public function __construct () {
    $this->view = new CourseAdminView();
  }

  public function defaultAction() {
    $this->getView()->addAddButton();
    parent::defaultAction();
  }

  public function addCourse() {
    $this->getView()->addNewCourseInput();
    parent::defaultAction();
  }

  public function saveNewCourse() {
    if (!isset($_POST['nameEN']) || empty($_POST['nameEN']) || !isset($_POST['nameDE']) || empty($_POST['nameDE'])) {
      $this->getView()->addErrorMessage('Please fill out all fields!');
      $this->addCourse();
    } else {
      $nameEN = $this->secureString($_POST['nameEN']);
      $nameDE = $this->secureString($_POST['nameDE']);
      if (Course::createCourse($nameEN, $nameDE)) {
        $this->getView()->addSuccessMessage('Course was successfully added.');
      } else {
        $this->getView()->addErrorMessage('Course could not be added!');
      }
      $this->defaultAction();
    }
  }


  public function deleteCourse() {
    if (isset($_POST['confirmed']) && $_POST['confirmed']==='true') {
      $id = $this->secureString($_POST['courseId']);
      if (Course::deleteCourse($id)) {
        $this->getView()->addSuccessMessage('Course was successfully deleted.');
      } else {
        $this->getView()->addErrorMessage('Course could not be deleted!');
      }
    } else {
      $this->getView()->addWarnMessage('Are you sure you want to delete this course?');
      $this->getView()->addDeleteConfirmation();
    }
    $this->defaultAction();
  }

}

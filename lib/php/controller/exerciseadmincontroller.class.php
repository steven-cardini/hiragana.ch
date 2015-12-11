<?php
class ExerciseAdminController extends Controller {

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
    $this->view = new ExerciseAdminView($this->lesson, $this->course);
  }

  public function defaultAction() {
    //$this->getView()->addAddButton();
    parent::defaultAction();
  }

  public function saveExercises() {
    $successful = true;
    for ($i=0; $i<count($_POST['exercise_id']); $i++) {
      $id = $this->secureString($_POST['exercise_id'][$i]);
      $question = $this->secureString($_POST['question'][$i]);
      $answerEN = $this->secureString($_POST['answer_en'][$i]);
      $answerDE = $this->secureString($_POST['answer_de'][$i]);

      if (!Exercise::update($id, $question, $answerEN, $answerDE)) {
        $successful = false;
      }
    }

    if ($successful) {
      $this->getView()->addSuccessMessage('Exercises were successfully saved!');
    } else {
      $this->getView()->addErrorMessage('There was a problem saving one or more exercises..');
    }

    $this->defaultAction();
  }

}

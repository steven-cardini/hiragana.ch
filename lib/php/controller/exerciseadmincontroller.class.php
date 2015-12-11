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
    $updateAmount = (isset($_POST['exercise_id']) && !empty($_POST['exercise_id'])) ? count($_POST['exercise_id']) : 0;
    $i = 0;
    // update exercises that were present in DB already
    while ($i<$updateAmount) {
      $id = $this->secureString($_POST['exercise_id'][$i]);
      $question = $this->secureString($_POST['question'][$i]);
      $answerEN = $this->secureString($_POST['answer_en'][$i]);
      $answerDE = $this->secureString($_POST['answer_de'][$i]);
      // do not update exercises with empty fields
      if (empty($id) || empty($question) || empty($answerEN) || empty($answerDE)) {
        $i++;
        continue;
      }

      if (!Exercise::update($id, $question, $answerEN, $answerDE)) {
        $successful = false;
      }

      $i++;
    }
    // add new exercises to DB
    while ($i<count($_POST['question'])) {
      $question = $this->secureString($_POST['question'][$i]);
      $answerEN = $this->secureString($_POST['answer_en'][$i]);
      $answerDE = $this->secureString($_POST['answer_de'][$i]);
      // do not add exercises with empty fields
      if (empty($question) || empty($answerEN) || empty($answerDE)) {
        $i++;
        continue;
      }

      if (!Exercise::createExercise($this->lesson->getId(), $question, $answerEN, $answerDE)) {
        $successful = false;
      }

      $i++;
    }

    if ($successful) {
      $this->getView()->addSuccessMessage('Exercises were successfully saved!');
    } else {
      $this->getView()->addErrorMessage('There was a problem saving one or more exercises..');
    }

    $this->defaultAction();
  }

}

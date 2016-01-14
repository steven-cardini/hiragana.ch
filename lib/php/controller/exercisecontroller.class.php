<?php
class ExerciseController extends Controller {

  protected $view;
  private $lesson;
  private $course;

  public function __construct() {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
      die ("Please first select a lesson!");
    }
    $lessonId = $this->secureString($_GET['id']);
    $this->lesson = Lesson::getLesson($lessonId);
    if (!isset($this->lesson)) {
      die ("This lesson was not found!");
    }
    $this->course = Course::getCourseById($this->lesson->getCourseId());
    $this->view = new ExerciseView($this->lesson, $this->course);
  }

  public function defaultAction() {
    $newExercise = Exercise::getNotAnsweredExercise($_SESSION['user']->getEmail(), $this->lesson->getId());
    if (!isset($newExercise)) {
      die ('You answered all questions!');
    }
    $_SESSION['currentExercise'] = $newExercise;
    $this->getView()->setQuestion($_SESSION['currentExercise']->getQuestion());
    parent::defaultAction();
  }

  public function evaluate() {
    if (isset($_POST['answer']) && !empty($_POST['answer'])) {
      $input = $this->secureString($_POST['answer']);
      $correct = $_SESSION['currentExercise']->getAnswer('en');

      $removedChars = '/(\W+)|[0-9]|_/';
      $input = trim($input);
      $input = preg_replace($removedChars, '', $input);
      $correct = trim($correct);
      $correct = preg_replace($removedChars, '', $correct);

      if (strtolower($input)===strtolower($correct)) {
        $updated = Exercise::addCorrectAnswer($_SESSION['user']->getEmail(), $_SESSION['currentExercise']->getId());
        if (!$updated) {
          $this->getView()->addErrorMessage('Could not update DB.');
        }
        $this->getView()->addSuccessMessage('Correct!');
      } else {
        $this->getView()->addErrorMessage('Wrong!');
      }
    }

    $this->defaultAction();
  }


/*
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
  } */

}

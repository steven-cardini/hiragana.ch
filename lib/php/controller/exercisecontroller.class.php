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
      die (I18n::t('exercise.err.allanswered'));
    }
    $_SESSION['currentExercise'] = $newExercise;
    $this->getView()->setQuestion($_SESSION['currentExercise']->getQuestion());
    parent::defaultAction();
  }

  public function evaluate() {
    if (isset($_POST['answer']) && !empty($_POST['answer'])) {
      $input = $this->secureString($_POST['answer']);
      $correct = $_SESSION['currentExercise']->getAnswer(I18n::getLang());

      // trim whitespaces, remove not relevant characters in order to be more flexible with user input
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
        $this->getView()->addSuccessMessage(I18n::t('exercise.correct'));
      } else {
        $this->getView()->addErrorMessage(I18n::t('exercise.wrong'));
      }
    }

    $this->defaultAction();
  }

}

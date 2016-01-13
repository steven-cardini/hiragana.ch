<?php
  if (!isset($_GET['id']) || empty($_GET['id'])) {
    die ("Please first select a lesson!");
  }
  $lessonId = htmlspecialchars($_GET['id']);
  $lessonId = DB::escapeString($lessonId);
  $lesson = Lesson::getLesson($lessonId);

  if (!isset($lesson)) {
    die ("This lesson was not found!");
  }

  $exercise = Exercise::getRandomExercise($lessonId);

?>

  <h1><?php echo $lesson->getName('en'); ?>: Exercises</h1>
  Question: <?php echo $exercise->getQuestion();

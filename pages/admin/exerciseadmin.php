<?php
include AUTH_DIR.'requireadminrights.routine.php';

FrontController::display(new ExerciseAdminController());

/*
if (isset($_POST[$FIELD_EXERCISE_ID])) {
  for ($i=0; $i<count($_POST[$FIELD_EXERCISE_ID]); $i++) {
    $id = htmlspecialchars($_POST[$FIELD_EXERCISE_ID][$i]);
    $id = DB::escapeString($id);
    $question = htmlspecialchars($_POST[$FIELD_QUESTION][$i]);
    $question = DB::escapeString($question);
    $answerEN = htmlspecialchars($_POST[$FIELD_ANSWER_EN][$i]);
    $answerEN = DB::escapeString($answerEN);
    $answerDE = htmlspecialchars($_POST[$FIELD_ANSWER_DE][$i]);
    $answerDE = DB::escapeString($answerDE);

    Exercise::update($id, $question, $answerEN, $answerDE);
  }
}

$lessonId = htmlspecialchars($_GET['id']);
$lessonId = DB::escapeString($lessonId);

$lesson = Lesson::getLesson($lessonId);
$exercises = Exercise::getMultipleExercises($lessonId, 50, 0);
*/

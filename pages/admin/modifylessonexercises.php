<?php
include AUTH_DIR.'requireadminrights.routine.php';

$FIELD_EXERCISE_ID = "exercise_id";
$FIELD_QUESTION = "question";
$FIELD_ANSWER_EN = "answer_en";
$FIELD_ANSWER_DE = "answer_de";


if (!isset($_GET['id']) || empty($_GET['id'])) {
  die ("Please first select a lesson!");
}

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
?>
<h1>Lesson Administration</h1>
<h2><?php echo $lesson->getName('en'); ?></h2>

<form method="post" action="<?php echo ROOT_DIR; ?>admin/modifylessonexercises/<?php echo $lessonId; ?>">
<table class="table table-hover">
    <thead>
      <tr>
        <th>Question</th>
        <th>Answer (EN)</th>
        <th>Answer (DE)</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($exercises as $exercise) {
        echo '<tr><input type="hidden" name="'.$FIELD_EXERCISE_ID.'[]" value="'.$exercise->getId().'" />
                <td><input type="text" name="'.$FIELD_QUESTION.'[]" value="'.$exercise->getQuestion().'" /></td>
                <td><input type="text" name="'.$FIELD_ANSWER_EN.'[]" value="'.$exercise->getAnswer('en').'" /></td>
                <td><input type="text" name="'.$FIELD_ANSWER_DE.'[]" value="'.$exercise->getAnswer('de').'" /></td>
              </tr>';
      } ?>
    </tbody>
  </table>
  <input type="submit" value="Save" />
  </form>

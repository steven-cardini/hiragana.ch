<?php
require AUTH_DIR.'requireadminrights.routine.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
  die ("Please first select a lesson!");
}

$lessonId = $_GET['id'];
$lesson = Lesson::getLesson($lessonId);
$courseId = $lesson->getCourseId();
echo 'lesson id = '.$lessonId;
$content_location = PAGE_DIR."lessons/$courseId-$lessonId.html";

 ?>
<script>
  var courseId = <?php echo json_encode($courseId); ?>;
  var lessonId = <?php echo json_encode($lessonId); ?>;
</script>
<div id="lesson-tutorial-feedback" class="alert" role="alert">&nbsp;</div>
<form>
  <textarea name="editor1" id="editor1" rows="10" cols="80">
    Content is loading, please wait..
  </textarea>
</form>
<button id="lesson-tutorial-save" class="btn btn-default">Save</button>

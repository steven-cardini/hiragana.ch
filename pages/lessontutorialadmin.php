<?php

if (!isset($_POST['lesson_id']) || empty($_POST['lesson_id'])) {
  //die ("Please first select a lesson!");
  $_POST['lesson_id']=1;
}

$lessonId = $_POST['lesson_id'];
$content_location = PAGE_DIR."lessons/$lessonId.html";

 ?>
<script>
  var lessonId = <?php echo json_encode($lessonId); ?>;
</script>
<div id="lesson-tutorial-feedback" class="alert" role="alert">&nbsp;</div>
<form>
  <textarea name="editor1" id="editor1" rows="10" cols="80">
    Content is loading, please wait..
  </textarea>
</form>
<button id="lesson-tutorial-save" class="btn btn-default">Save</button>

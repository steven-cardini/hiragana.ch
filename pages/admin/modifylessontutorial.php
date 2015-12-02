<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
  die ("Please first select a lesson!");
}

$lessonId = $_GET['id'];
echo 'lesson id = '.$lessonId;
$content_location = PAGE_DIR."lessons/$lessonId.html";
echo '<br>location = '.$content_location;


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

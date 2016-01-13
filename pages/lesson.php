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

  $courseId = $lesson->getCourseId();
  $filePath = PAGE_DIR."lessons/$courseId-$lessonId.html";

  $exerciseComponent = '<div class="well ui">
    <form action="'.ROOT_DIR.'exercises/'.$lessonId.'" method="post">
      <button type="submit" class="btn btn-default btn-block">Start exercises</button>
    </form>
  </div>';

  // display content
  echo '<h1>'.$lesson->getName('en').'</h1>';
  echo $exerciseComponent;
  if (file_exists($filePath) && filesize($filePath) > 1) {
    echo '<h2>Tutorial</h2>';
    echo file_get_contents($filePath);
    echo $exerciseComponent;
  }
